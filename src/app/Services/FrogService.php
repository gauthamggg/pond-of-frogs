<?php namespace App\Services;


use App\Exceptions\FrogAlreadyDeadException;
use App\Exceptions\FrogCreationException;
use App\Exceptions\FrogCreationValidationException;
use App\Exceptions\FrogGayException;
use App\Exceptions\FrogNecrophiliaException;
use App\Exceptions\FrogTouchingSelfException;
use App\Models\Frog;
use \Validator;

class FrogService {

    /**
     * @var \App\Models\Frog
     */
    protected $frog;

    /**
     * @var \Validator
     */
    public $validator;

    /**
     * @var array
     */
    protected $validationRules = [
        'name' => 'required|max:100|min:5',
        'gender' => 'required',
    ];

    /**
     * @param Frog $frog
     */
    public function __construct(Frog $frog)
    {
        $this->frog = $frog;
    }

    /**
     * Sets frog to work with.
     *
     * @param $frog
     */
    public function setFrog($frog)
    {
        $this->frog = $frog;
    }

    /**
     * Gets active frog.
     *
     * @return Frog
     */
    public function getFrog()
    {
        return $this->frog;
    }

    /**
     * Creates a frog.
     *
     * @param $data
     * @return Frog
     * @throws \App\Exceptions\FrogCreationException
     * @throws \App\Exceptions\FrogCreationValidationException
     */
    public function create($data)
    {
        $this->validator = Validator::make($data, $this->validationRules);

        if ($this->validator->fails()) {
            throw new FrogCreationValidationException();
        }
        try {
            $data['is_dead'] = 0; //of course its alive
            $newFrog = $this->frog->create($data);
        } catch (\Exception $e) {
            throw new FrogCreationException();
        }
        return $newFrog;
    }

    /**
     * Updates a frog.
     *
     * @param $data
     * @return Frog
     * @throws \App\Exceptions\FrogCreationException
     * @throws \App\Exceptions\FrogCreationValidationException
     */
    public function update($data)
    {
        $this->validator = Validator::make($data, $this->validationRules);

        if ($this->validator->fails()) {
            throw new FrogCreationValidationException();
        }
        try {
            $this->frog->update($data);
        } catch (\Exception $e) {
            throw new FrogCreationException($e->getMessage());
        }
        return $this->frog;
    }

    /**
     * Mates with other frog.
     *
     * @param $partnerFrog
     * @return Frog
     * @throws \App\Exceptions\FrogGayException
     * @throws \App\Exceptions\FrogTouchingSelfException
     * @throws \App\Exceptions\FrogNecrophiliaException
     */
    public function mateWith($partnerFrog)
    {
        //both should be alive
        if($this->frog->is_dead || $partnerFrog->is_dead)
        {
            throw new FrogNecrophiliaException();
        }

        //both should be a different frog.
        if($this->frog->id == $partnerFrog->id)
        {
            throw new FrogTouchingSelfException();
        }

        //should be in opposite sex.
        if($this->frog->gender == $partnerFrog->gender)
        {
            throw new FrogGayException();
        }

        return $this->makeBaby($partnerFrog);
    }

    /**
     * Kills a frog *sigh*
     *
     * @return bool
     * @throws \App\Exceptions\FrogAlreadyDeadException
     * @throws \App\Exceptions\FrogCreationException
     */
    public function feedToSnake()
    {
        //you can not kill a dead frog.
        if($this->frog->is_dead)
        {
            throw new FrogAlreadyDeadException();
        }
        try
        {
            $this->frog->is_dead = 1;
            $this->frog->save();
        }catch (\Exception $e)
        {
            throw new FrogCreationException();
        }
        return true;
    }

    /**
     * Creates a new frog based on the parent's names.
     *
     * @param $partnerFrog
     * @return Frog
     */
    protected function makeBaby($partnerFrog)
    {
        $childFrog = new Frog();
        $childFrog->name = $this->frog->name . ' ' . $partnerFrog->name . ' ' . 'Tadpole';
        $genders = ['M', 'F'];
        $childFrog->gender = $genders[array_rand($genders)]; //we dont know the gender yet.
        $childFrog->is_dead = 0; //have mercy, baby should be alive.
        $childFrog->save();
        return $childFrog;
    }
} 