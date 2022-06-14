<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 
        $categories = Category::paginate(10);
        return view('admin.category', compact('categories','totalAlert'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the resource
        $request->validate([
            'name' => 'required',
        ]);

        //store the resource
        $store = Category::create([
            
             'name' => $request->name,
        ]);

        if($store){
            $request->session()->flash('success', 'Category has been added successfully...');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        //validate the resource
        $request->validate([
            'name' => 'required',
        ]);

        //store the resource
        $update = Category::where('id', $request->category_id)
                         ->update([
            
                                 'name' => $request->name,
                                 ]);

        if($update){
            $request->session()->flash('success', 'Category has been updated successfully...');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        
        $delete = Category::where('id', $request->category_id)
                           ->delete();
        if($delete){

            $request->session()->flash('delete', 'Category has been deleted successfully...');
            return back();
        }
        
    }


    /**=========================== Category Search method ====================== */
    public function search(Request $request){
        $search_value = $request->value;
        // get the value
        if($search_value !=''){

            $categories =Category::where('name','like', '%'.$search_value.'%')
            ->simplePaginate(10);  
           
        }

        $html = ' ';
        $loop = 0;
        foreach($categories as $category){

            $html .='<tr>
            <td>'.++$loop.'</td>
            <td class="category_'.$category->id.'">'.$category->name.'</td>
           <td>
           <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editCategory"  onclick="editFunction('.$category->id.')">Edit</button>
           <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteCategory"  onclick="deleteFunction('.$category->id.')">Delete</button>
           </td></tr>';
        }

        return response()->json([
           'category' => $html 
        ]);
    }
}
           
          

