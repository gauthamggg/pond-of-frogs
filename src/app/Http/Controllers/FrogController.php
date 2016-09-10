<?php namespace App\Http\Controllers;

use App\Exceptions\FrogCreationException;
use App\Exceptions\FrogCreationValidationException;
use App\Models\Frog;
use App\Services\FrogService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \Validator;

class FrogController extends Controller
{

    /**
     * Show the list of Frogs.
     *
     * @return Response
     */
    public function index()
    {
        return view('frog.index', ['frogs' => Frog::paginate(15)]);
    }

    /**
     * Show the create Frog form.
     *
     * @return Response
     */
    public function create()
    {
        return view('frog.create');
    }

    /**
     * Store the incoming frog.
     *
     * @param  Request $request
     * @param  FrogService $frogService
     * @return Response
     */
    public function store(Request $request, FrogService $frogService)
    {
	
		$frogeObject = new Frog();
		$frogeObject->name = $request->name;
		$frogeObject->gender = $request->gender;
		$frogeObject->save();
		/* dd($request->name);
        $data = $request->except(['_token', '_method']);
        try {
            $frogService->create($data);
        } catch (FrogCreationValidationException $e) {
            $this->notify->addFlash($e->getMessage(), 'danger');
            return redirect()->back()->withErrors($frogService->validator)->withInput();
        } catch (FrogCreationException $e) {
            $this->notify->addFlash($e->getMessage(), 'danger');
            return redirect()->back()->withInput();
        }
        $this->notify->addFlash('New frog as been added to your pond!', 'success'); */
		
        return redirect(route('frog.index'));
    }

    /**
     * Show frog edit form.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Http\Redirector
     */
    public function edit($id)
    {
        $frog = Frog::find($id);
        if (!$frog) {
            return $this->notFoundBackToIndex();
        }
        return view('frog.edit', ['frog' => $frog]);
    }

    /**
     * Update the frog.
     *
     * @param  int $id
     * @param  Request $request
     * @param  FrogService $frogService
     * @return Response
     */
    public function update( Request $request,$id)
    {
              $frog = Frog::find($id);
		$frog->name = $request['name'];
        $frog->gender = $request['gender'];
      
        $frog->save();
		    return redirect()->route('frog.index');
       /* if (!$frog) {
            return $this->notFoundBackToIndex();
        }

        $frogService->setFrog($frog);

        $data = $request->except(['_token', '_method']);
        try {
            $frogService->update($data);
        } catch (FrogCreationValidationException $e) {
            $this->notify->addFlash($e->getMessage(), 'danger');
            return redirect()->back()->withErrors($frogService->validator)->withInput();
        } catch (FrogCreationException $e) {
            $this->notify->addFlash($e->getMessage(), 'danger');
            return redirect()->back()->withInput();
        }
        $this->notify->addFlash('Successfully updated your frog!', 'success');
        return redirect(route('frog.index'));*/
    }

    /**
     * Kill the frog.
     *
     * @param $id
     * @param FrogService $frogService
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    
   
}