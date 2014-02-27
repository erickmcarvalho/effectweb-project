<?php
error_reporting(0);

/**
* Classe que gera logo da guild
*
* @author Fabricio Augusto (Fabricionaweb) <fabricionaweb@gmail.com>
* @editor Erick Anthony (Erick-Master) <www.cetemaster.com.br>
* @copyright Copyright © 2011, AT7 Design
* @version 1.2
* @access public
* @final
*/
final class GuildMark //gmark
{
    /**
    * Variável que recebe tamanho da logo
    * @access private
    * @name $size
    */ 
    private static $size = 32; # Defina um tamanho padrão (multiplo de 8)
    
    /**
    * Variável que recebe o hexadecimal da logo
    * @internal
    * @access private
    * @name $mark
    */ 
    private static $mark;
    
    /**
    * Variável que recebe o tamanho de cada pixel (tamanho/8)
    * @internal
    * @access private
    * @name $px
    */ 
    private static $px;
    
    /**
    * Variável que recebe a imagem
    * @internal
    * @access private
    * @name $image
    */ 
    private static  $image;
    
    /**
    * Função construtora que recebe os paramentros para gerar a logo.
    * @access public
    * @param string $m Hexadecimal da logo
    * @param int $s Tamanho da logo
    * @return void
    */
    public static function getMark($m, $s)
    {
       // if($s > 0 && $s <= 64 && ($s % 8) == 0)
            self::$size = $s;
        
        self::createImage();
        
        $m = strtoupper($m);
        if(preg_match('/^[A-F0-9]{64}$/', $m))
            self::$mark = $m;
        
        self::generate();
    }
    
    /**
    * Cria a imagem e define o tamanho dos pixels
    * @internal
    * @access private
    * @return void
    */
    private static function createImage()
    {
        self::$px = self::$size/8;
        self::$image = imagecreate(self::$size, self::$size);
        imagecolorallocatealpha(self::$image, 255, 255, 255, 127);
    }
    
    /**
    * Cria um X para casos de erro
    * @internal
    * @access private
    * @return void
    */
    private static function error()
    {
        $color = self::getColor(4);
        imageline(self::$image, 0, 0, self::$size, self::$size, $color);
        imageline(self::$image, 0, self::$size-1, self::$size-1, 0, $color);
    }
    
    /**
    * Cria a logo
    * @internal
    * @access private
    * @return void
    */
    private static function generate()
    {
        if(!self::$mark)
            self::error();
        else
        {
            $h = 0;
            for($i=0;$i<8;$i++)
            {
                for($j=0;$j<8;$j++)
                {
                    $char = substr(self::$mark, $h++, 1);
                    $color = self::getColor($char);
                    
                    if(!$color)
                        continue;
                        
                    $x = $j*self::$px;
                    $y = $i*self::$px;
                    
                    imagefilledrectangle(self::$image, $x, $y, $x+self::$px, $y+self::$px, $color);
                }
            }
        }
        
        self::montImage();
    }
    
    /**
    * Retorna a cor referente à solicitada
    * @internal
    * @access private
    * @param int $cod O código da cor na string hexadecimal
    * @return mixed|false função com a cor referente à solicitada, false
    */
    private static function getColor($cod)
    {
        switch($cod)
        {
            case 1 : $color = array(0 ,0, 0); break;
            case 2 : $color = array(128, 128, 128); break;
            case 3 : $color = array(255, 255, 255); break;
            case 4 : $color = array(255, 0, 0); break;
            case 5 : $color = array(255, 128, 0); break;
            case 6 : $color = array(255, 255, 0); break;
            case 7 : $color = array(128, 255, 0); break;
            case 8 : $color = array(0, 255, 1); break;
            case 9 : $color = array(0, 255, 128); break;
            case 'A' : $color = array(0, 255, 255); break;
            case 'B' : $color = array(0, 128, 255); break;
            case 'C' : $color = array(0, 0, 255); break;
            case 'D' : $color = array(128, 0, 255); break;
            case 'E' : $color = array(255, 0, 255); break;
            case 'F' : $color = array(255,0 ,128); break;
            default : return false; break;
        }
        
        return imagecolorallocate(self::$image, $color[0], $color[1], $color[2]);
    }
    
    /**
    * Constroi cabeçalho de imagem para o navegador
    * @internal
    * @access private
    * @return void
    */
    private static function montImage()
    {
        header('Content-type: image/png', true);
        imagepng(self::$image, false, 9);
        imagedestroy(self::$image);
    }
}