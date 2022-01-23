<?
  /**************************************************************
  
    authImage PHP class
    version 0.2

    Author:       Cezary Piekacz :: Cezex
    Release date: 2006-09-20
    Last update:  2006-11-07
    License:      GPL, http://www.gnu.org/copyleft/gpl.html
    
    For more information visit: http://redfish.pl/apps/authimage
    
  ***************************************************************/

  class authImage {

    // BEGIN CONFIGURATION
    // **************************************************************
    
    // Unique password for better encryption, enter whatever you like    
    
    var $uniqPasswd = '#@4f*hs86^sd%';

    // Cookie name, enter whatever you like    
    
    var $cookieName = 'AuthImageCode';
    
    // Length of the generated code
    
    var $codeLength = 6;
    
    // Font properties
    
    var $font       = Array(
                        'path'     => 'verdana.ttf',
                        'minSize'  => 10,
                        'maxSize'  => 14,
                        'minAngle' => -30,
                        'maxAngle' => 30,
                      );
    
    // Width and heigh of created image
    
    var $width      = 100;
    var $height     = 30;
    
		// Background color

		var $bgColor    = Array(255, 255, 255);
		
    // **************************************************************
    // END CONFIGURATION

		// Set image background color; You can use an array [red, green, blue],
		// hex code: "#000000", or rgb value: "red,green,blue"
		
		function setBgColor($color) {
			if (is_array($color))
				$this->bgColor = $color;
			
			elseif (preg_match('/^#([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})$/i', $color, $match))
				$this->bgColor = Array(hexdec($match[1]), hexdec($match[2]), hexdec($match[3]));

			elseif (preg_match('/^([0-9]{3}), *([0-9]{3}), *([0-9]{3})$/i', $color, $match))
				$this->bgColor = Array(hexdec($match[1]), hexdec($match[2]), hexdec($match[3]));
		}
		
    // Create random text used in validation process

    function createRandomText() {
      $input = md5(time());

      while (strlen($output) < $this->codeLength) {
				$l = $input[rand(0,31)];
				if (!preg_match('/[0ol12z]/i', $l))
	        $output .= $l;
			}

      return strtolower($output);
    }
    
		// Encrypt generated code

    function cipherCode($code) {
      return md5($code . $this->uniqPasswd);
    }
    
		// Create authentication code and save it in cookie

    function createAuthCode() {
      $code = $this->createRandomText();
  
      SetCookie($this->cookieName, $this->cipherCode($code));
    
      return $code;
    }

		// Check authentication code and destroy the cookie

    function validateAuthCode($code) {

      $cookie_code = $_COOKIE[$this->cookieName];
      SetCookie($this->cookieName, '', time() - 1);
      
      if (strcmp($cookie_code, $this->cipherCode(strtolower($code))) == 0)
				return true;
			
			else
				return false;
    }

		// Create an image with authentication code

    function createImage() {
      $code = $this->createAuthCode();
  
      // Make image expire as soon as it is displayed
      
      header('Content-type:image/png'); 
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
      header('Cache-Control: no-store, no-cache, must-revalidate'); 
      header('Cache-Control: post-check=0, pre-check=0', false);

      $img   = ImageCreate($this->width, $this->height);
      $white = ImageColorAllocate($img, $this->bgColor[0], $this->bgColor[1], $this->bgColor[2]);
      
      // Fill background with white colour
      
      ImageFill ($img, 1, 5, $white); 
      
      // Draw an authentication code composed of numbers and letters
      
      for ($i = 0; $i < strlen($code); $i++) {
        $color = ImageColorAllocate($img, rand(0,200), rand(0, 200), rand(0, 200));
      
        ImageTTFText(
          $img,
          rand($this->font['minSize'], $this->font['maxSize']),         // font size
          rand($this->font['minAngle'], $this->font['maxAngle']),       // angle
          ($this->font['maxSize'] / 3) + ($i * $this->font['maxSize']), // x
          rand($this->font['maxSize'] + ($this->font['maxSize'] / 3), $this->height - ($this->font['maxSize'] / 3)),
                                                                        // y
          $color,                                                       // color
          $this->font['path'],                                          // font
          $code[$i]                                                     // text
        );

      }

      ImagePNG($img);
      ImageDestroy($img);
    }
    
  }
?>
