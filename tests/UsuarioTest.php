<?php
require_once 'libs/vendor/autoload.php';
require_once 'DAO/DAOUsuario.php';
require_once 'models/Usuario.php';

use DAO\DAOUsuario;
use models\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTeste extends TestCase
{
    private $daoUsuario;

    protected function setUp(): void
    {
        $this->daoUsuario = new DAOUsuario();
    }

    public function testLogar()
    {
        $usuario = $this->daoUsuario->logar('testuser', 'testpassword');
        $this->assertInstanceOf(Usuario::class, $usuario);
        $this->assertTrue($usuario->getLogado());
    }

    public function testLogarInvalido()
    {
        $usuario = $this->daoUsuario->logar('invaliduser', 'invalidpassword');
        $this->assertInstanceOf(Usuario::class, $usuario);
        $this->assertFalse($usuario->getLogado());
    }

    public function testIncluirUsuario()
    {
        $nome = 'Test User';
        $email = 'test@example.com';
        $login = 'testuser';
        $senha = 'testpassword';

        $result = $this->daoUsuario->incluirUsuario($nome, $email, $login, $senha);
        $this->assertTrue($result);
    }

    public function testIncluirUsuarioComErro()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Não foi possível incluir novo usuário');

        $this->daoUsuario->incluirUsuario('', '', '', '');
    }
}

