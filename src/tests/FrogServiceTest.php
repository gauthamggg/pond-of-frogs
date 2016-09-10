<?php

class FrogServiceTest extends TestCase {

    /**
     * @var \App\Services\FrogService
     */
    protected $frogService;

    public function setUp()
    {
        parent::setUp();

        $this->frogService = new \App\Services\FrogService(new \App\Models\Frog());

    }
    public function testCreateFrogSuccess()
    {
        $data = [
            'name' => 'Test Frog',
            'gender' => 'M'
        ];

        $frog = $this->frogService->create($data);

        $this->assertInstanceOf('\App\Models\Frog',$frog);

    }

    public function testCreateFrogThrowValidationError()
    {
        $data = [
            'name' => 'Test Frog'
        ];
        $this->setExpectedException('App\Exceptions\FrogCreationValidationException');
        $frog = $this->frogService->create($data);
    }


    public function testUpdateFrogSuccess()
    {
        $data = [
            'name' => 'Test Frog',
            'gender' => 'M'
        ];

        $frog = $this->frogService->create($data);

        $updateData = [
            'name' => 'Test Frog Update',
            'gender' => 'F'
        ];

        $this->frogService->setFrog($frog);

        $updateFrog = $this->frogService->update($updateData);

        $this->assertEquals($updateFrog->name, 'Test Frog Update');

    }

    public function testUpdateFrogThrowValidationError()
    {
        $data = [
            'name' => 'Test Frog',
            'gender' => 'M'
        ];

        $frog = $this->frogService->create($data);

        $updateData = [
            'name' => 'Test Frog Update',
        ];

        $this->frogService->setFrog($frog);

        $this->setExpectedException('App\Exceptions\FrogCreationValidationException');

        $frog = $this->frogService->update($updateData);
    }

    public function testDeadFrogsMatingException()
    {
        $deadFrogOne = new \App\Models\Frog();

        $deadFrogOne->name = 'Dead Frog 1';
        $deadFrogOne->gender = 'M';
        $deadFrogOne->is_dead = true;

        $deadFrogTwo = new \App\Models\Frog();

        $deadFrogTwo->name = 'Dead Frog 2';
        $deadFrogTwo->gender = 'F';
        $deadFrogTwo->is_dead = true;

        $this->frogService->setFrog($deadFrogOne);

        $this->setExpectedException('App\Exceptions\FrogNecrophiliaException');

        $this->frogService->mateWith($deadFrogTwo);

    }


    public function testMasturbatingFrogException()
    {
        $deadFrogOne = new \App\Models\Frog();

        $deadFrogOne->name = 'Dead Frog 1';
        $deadFrogOne->gender = 'M';
        $deadFrogOne->is_dead = false;


        $this->frogService->setFrog($deadFrogOne);

        $this->setExpectedException('App\Exceptions\FrogTouchingSelfException');

        $this->frogService->mateWith($deadFrogOne);

    }


    public function testGayFrogException()
    {
        $maleFrogOne = new \App\Models\Frog();

        $maleFrogOne->name = 'Male Frog 1';
        $maleFrogOne->gender = 'M';
        $maleFrogOne->is_dead = false;
        $maleFrogOne->save();

        $maleFrogTwo = new \App\Models\Frog();

        $maleFrogTwo->name = 'Male Frog 2';
        $maleFrogTwo->gender = 'M';
        $maleFrogTwo->is_dead = false;
        $maleFrogTwo->save();

        $this->frogService->setFrog($maleFrogOne);

        $this->setExpectedException('App\Exceptions\FrogGayException');

        $this->frogService->mateWith($maleFrogTwo);

    }


    public function testSuccessfulMating()
    {
        $maleFrogOne = new \App\Models\Frog();

        $maleFrogOne->name = 'FeMale Frog 1';
        $maleFrogOne->gender = 'F';
        $maleFrogOne->is_dead = false;
        $maleFrogOne->save();

        $femaleFrogTwo = new \App\Models\Frog();

        $femaleFrogTwo->name = 'Male Frog 2';
        $femaleFrogTwo->gender = 'M';
        $femaleFrogTwo->is_dead = false;
        $femaleFrogTwo->save();

        $this->frogService->setFrog($maleFrogOne);

        $baby = $this->frogService->mateWith($femaleFrogTwo);

        $this->assertInstanceOf('\App\Models\Frog', $baby);

    }

    public function testKillFrogAlreadyDeadException()
    {
        $deadFrogOne = new \App\Models\Frog();

        $deadFrogOne->name = 'Dead Frog 1';
        $deadFrogOne->gender = 'M';
        $deadFrogOne->is_dead = true;


        $this->frogService->setFrog($deadFrogOne);

        $this->setExpectedException('App\Exceptions\FrogAlreadyDeadException');

        $this->frogService->feedToSnake($deadFrogOne);

    }

    public function testKillFrogSuccess()
    {
        $deadFrogOne = new \App\Models\Frog();

        $deadFrogOne->name = 'Dead Frog 1';
        $deadFrogOne->gender = 'M';
        $deadFrogOne->is_dead = false;


        $this->frogService->setFrog($deadFrogOne);

        $result = $this->frogService->feedToSnake($deadFrogOne);

        $this->assertTrue($result);

    }
}
