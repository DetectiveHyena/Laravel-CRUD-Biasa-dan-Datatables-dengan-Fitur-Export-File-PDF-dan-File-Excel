<?php

namespace App\Http\Controllers;

use App\Exports\KpopsExport;
use App\Kpop;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use File;

class KpopController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    
        $perHalaman = 3;
        $totalagensi = Kpop::count();
        $kpops = Kpop::orderBy('id','desc')->paginate($perHalaman);
        $halaman = $perHalaman * ($kpops->currentPage() - 1);
        return view('kpops.index', compact('kpops','halaman','totalagensi'));
    }

    public function printpdf() {
        
        $kpops = Kpop::orderBy('id','desc')->get();
        $pdf   = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf   = PDF::loadview('kpops.printpdf', ['kpops' => $kpops]);
        $pdf->setPaper('f4', 'potrait');
        return $pdf->stream();
    }

    public function export() {

        return Excel::download(new KpopsExport, 'label-kpops.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('kpops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $this->validate($request,[
            'nama'=>'required',
            'ceo' =>'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png',
            'berdiri' => '',
            'medsos' => 'required'
        ]);

        $agensi = new Kpop;
        $agensi->nama = $request->nama;
        $agensi->ceo = $request->ceo;
        
        $logo = $request->logo;
        $namagambar = time().'.'.$logo->getClientOriginalExtension();
        $logo->move(public_path('gambar'),$namagambar);

        $agensi->logo = $namagambar;
        $agensi->berdiri = $request->berdiri;
        $agensi->medsos = $request->medsos;

        $agensi->save(); return redirect('/')->with('alert','Data berhasil ditambah.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $kpop = Kpop::find($id);
        return view('kpops.edit', compact('kpop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $agensi = Kpop::find($id);

        if($request->has('logo')) {
            $agensi->nama = $request->nama;
            $agensi->ceo = $request->ceo;
            
            $logo = $request->logo;
            $namagambar = time().'.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('gambar'),$namagambar);

            $agensi->logo = $namagambar;
            $agensi->berdiri = $request->berdiri;
            $agensi->medsos = $request->medsos;
        } else {

            $agensi->nama = $request->nama;
            $agensi->ceo = $request->ceo;
            $agensi->berdiri = $request->berdiri;
            $agensi->medsos = $request->medsos;
        }

        $agensi->update(); return redirect('/')->with('alert','Data berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $agensi = kpop::findOrFail($id);
        $namagambar = $agensi->logo;
        file::delete('gambar/'.$namagambar);
        $agensi->delete(); return redirect('/')->with('alert','Data berhasil dihapus.');
    }

    public function lookfor(Request $request) {
        $lookfor = $request->kata;
        $result_lookfor = Kpop::where('nama','like','%'.$lookfor.'%')
                                ->orwhere('ceo','like','%'.$lookfor.'%')
                                ->orwhere('berdiri','like','%'.$lookfor.'%')
                                ->orwhere('medsos','like','%'.$lookfor.'%')
                                ->get();

        return view('kpops.lookfor', compact('result_lookfor','lookfor'));
    }
    
}
