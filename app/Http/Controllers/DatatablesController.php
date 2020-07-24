<?php

namespace App\Http\Controllers;
use App\Kpop;
use DataTables;
use Illuminate\Http\Request;
use Validator;

class DatatablesController extends Controller {
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
   public function index(Request $request) {
        if ($request->ajax()) {
            $data = Kpop::orderBy('id','desc')
                        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class=" deleteData btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datatables.kpops');
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request) {
      
        $rules = array(
            'nama'    =>  'required',
            'ceo'     =>  'required',
            'logo'         =>  'required|image|max:2048',
            'berdiri'    =>  'required',
            'instagram'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('logo');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('gambar'), $new_name);

        $form_data = array(

        	'nama'    => $request->nama,
            'ceo'     =>  $request->ceo,
            'logo'         =>  $new_name,
            'berdiri'    =>  $request->berdiri,
            'medsos'     =>  $request->instagram
        );

        Kpop::create($form_data);

        return response()->json(['success' => 'Data Added successfully.'],200);
    }
    
     public function show($id)
    {
        //
    }
    
    public function edit($id)
    {

        if(request()->ajax())
        {
	        $data = Kpop::findOrFail($id);
	        return response()->json(['data' => $data]);
	        }
    }
    
    public function update (Request $request) {
        $gambar = $request->hidden_image;
        $logo = $request->file('logo');


        if($logo != '')
        {
            $rules = array(
                'nama'      => 'required',
                'ceo'       => 'required',
                'logo'      => 'image|max:2048',
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $gambarnama = rand() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('gambar'), $gambarnama);
        }
        else
        {
            $rules = array(
                'nama'      => 'required',
                'ceo'       => 'required',
                'logo'      => '',
                'berdiri'   => 'required',
                'instagram' => ''
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'nama'      => $request->nama,
            'ceo'       => $request->ceo,
            'logo'      => $gambarnama,
            'berdiri'   => $request->berdiri,
            'medsos' => $request->instagram
        );
        Kpop::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function destroy($id)
    {
        $data = Kpop::findOrFail($id);
        $data->delete();
    }  
}