<?php

    use \PHPUnit\Framework\TestCase;
    use LoginOpdracht\classes\User;

    class LoginTest extends TestCase 
    {
        protected $user;
        protected function setUp(): void
        {
            $this->user = new User();
        }


    public function testSetAndGetPassword()
    {
        $password = "bingbong!1";
        $this->user->SetPassword($password);
        $result = $this->user->GetPassword();
        $this->assertEquals($password, $this->user->GetPassword());
    }

    public function testValidateUserWithEmptyPassword()
    {
        $this->username = "feqEm";
        $errors = $this->user->ValidateUser();
        $this->assertContains("Username moet kleiner dan 3 en groter dan 50 tekens zijn.", $errors);
    }

    public function testRegisterUser()
    {
        $this->user->RegisterUser();
        $isDeleted = (session_status() == PHP_SESSION_NONE || empty(session_id()));
        $this->assertTrue(); // isDeleted
    }

    public function testValidateUserWithShortName()
    {
        $this->user->username = "ememe";
        $errors = $this->user->ValidateUser();
        $this->assertContains("Username moet > 3 en < 50 tekens zijn.", $errors);
    }

    public function testLogout()
    {
        session_start();
        $this->user->Logout();
        $isDeleted = (session_status() == PHP_SESSION_NONE || empty(session_id()));
        $this->assertTrue($isDeleted);
    }

    public function testIsLoggedInWhenNotLoggedIn()
    {
        $isLoggedIn = $this->user->IsLoggedIn();
        $this->assertFalse($isLoggedIn, "User is considered logged in when not logged in");
    }

    public function testIsLoggedInWhenLoggedIn()
    {
        session_start();
        $_SESSION['username'] = "test";
        $isLoggedIn = $this->user->IsLoggedIn();
        $this->assertTrue($isLoggedIn, "User is considered logged in when  logged in");
    }

    
    
    }

?>