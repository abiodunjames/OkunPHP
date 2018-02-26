<?php
declare(strict_types = 1);

namespace Test;

use App\Http\Auth\TokenService;

class TokenServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test Authentication token can be created
     *
     * @return void
     */
    public function testCanCreateToken()
    {
        $user = $this->getMockBuilder('App\Entities\User')
            ->setMethods(['getId'])
            ->getMock();

        $user->expects($this->once())
            ->method('getId')
            ->will($this->returnValue(1));


        $tokenService = new TokenService();
        $token = $tokenService->createTokenForUser($user);

        $expectedResult=1;
        $testResult =$tokenService->getUserIdFromToken($token);


        $this->assertInternalType('string', $token, "Got a ".gettype($token)." instead of a string");
        $this->assertEquals($expectedResult,$testResult);
        $this->assertTrue($tokenService->isValid($token));
    }

}
