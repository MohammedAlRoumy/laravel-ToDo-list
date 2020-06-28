<?php

namespace App\Http\Controllers;

use App\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = Task::paginate();
        return view('tasks.index', compact('tasks'));

    }

    public function getData(){
         $tasks = Task::all();
         $token = Session::token();
        foreach ($tasks as $task){
          //  echo"  <td style='font-size: 18px'>$task->name</td> <br>";
            echo " <tr> <td>$task->id</td>";
                if($task->status ==1){
                    echo" <td style='font-size: 18px;color:green;text-decoration: line-through;'>$task->name</td>";
                }else{
                    echo" <td style='font-size: 18px'>$task->name</td>";
                }
               echo" <td> <input type='checkbox' data-toggle='toggle'
                        data-id='$task->id' name='status' data-switchery='true'
                        class='js-switch tasks-switch'";

                        if($task->status ==1){ echo'checked';}
                        echo"> </td> ";


              echo"  <td>
                        <a href='tasks/$task->id/edit'"; /* echo" tasks/$task->id/edit"; */
                      echo"  class='btn btn-warning btn-sm'><i
                                class='fa fa-edit'></i> Edit</a> ";

                echo" <form action='tasks/$task->id'";
                         echo " method='post' style='display: inline-block'>";
                       echo"  <input type='hidden' name='_token' id='csrf-token' value='$token' /> ";

                        echo"  <input type='hidden' name='_method' value='DELET'>";
                         echo"   <button type='submit' class='btn btn-danger btn-sm delete'><i
                                    class='fa fa-trash'></i> Delete
                            </button>
                        </form>
                </td>
            </tr>
            ";
        }
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {

        $task = Task::findOrFail($request->task_id);
        $task->status = $request->status;
        $task->save();

        // return response()->json(['message' => 'User status updated successfully.']);
        return response()->json(['success' => 'Status change successfully.']);
        // session()->flash('success', 'Status change successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        Task::create($request->all());
        /* task::create($request->all());*/

        session()->flash('success', 'Data Added successfully');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $task = Task::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);


        $task->update($request->all());

        session()->flash('success', __('Data updated successfully'));
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //////////////////////////////
        $task = Task::findOrFail($id);

        //////////////////////////////
        $task->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('tasks.index');
    }

}
