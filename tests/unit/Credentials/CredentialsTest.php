<?php

namespace laravel\pagseguro\Tests\Unit\Credentials;

use laravel\pagseguro\Credentials\Credentials;

/**
 * Credentials Test
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testExceptionCredentialParamInvalid()
    {
        new Credentials(123456, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testExceptionCredentialParamEmailInvalid()
    {
        new Credentials('651233CECD6304779B7570BA2D06', 'teste');
    }

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testExceptionCredentialParamNull()
    {
        new Credentials(null, null);
    }

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testExceptionCredentialParamTokenNull()
    {
        new Credentials(null, 'michaeldouglas010790@gmail.com');
    }

    /**
     * @expectedException \InvalidArgumentException Invalid
     */
    public function testExceptionCredentialParamEmailNull()
    {
        new Credentials('651233CECD6304779B7570BA2D06', null);
    }
    
    public function testShouldReturnAgivenToken()
    {
        $credentials = new Credentials(
                '651233CECD6304779B7570BA2D06', 
                'michaeldouglas010790@gmail.com'
        );
        $this->assertEquals('651233CECD6304779B7570BA2D06', $credentials->getToken());
    }
    
    public function testShouldReturnAgivenEmail()
    {
        $credentials = new Credentials(
                '651233CECD6304779B7570BA2D06', 
                'michaeldouglas010790@gmail.com'
        );
        $this->assertEquals('michaeldouglas010790@gmail.com', $credentials->getEmail());
    }
    
    public function testShouldValidateCredentials()
    {
        $credentials = new Credentials(
                '651233CECD6304779B7570BA2D06', 
                'michaeldouglas010790@gmail.com'
        );
        $this->assertTrue($credentials->isValid());
    }
    
    public function testShouldReturnAnArrayWithAgivenCredential()
    {
        $credentials = new Credentials(
                '651233CECD6304779B7570BA2D06', 
                'michaeldouglas010790@gmail.com'
        );
        
        $array = $credentials->toArray();
        
        $this->assertEquals('651233CECD6304779B7570BA2D06', $array['token']);
        $this->assertEquals('michaeldouglas010790@gmail.com', $array['email']);
    }

    public function testIsOk()
    {
        $id = new Credentials('651233CECD6304779B7570BA2D06', 'isaquesb@gmail.com');
        $this->assertTrue($id->isValid());
        $this->assertEquals('651233CECD6304779B7570BA2D06', $id->getToken());
        $this->assertEquals('isaquesb@gmail.com', $id->getEmail());
    }
}
