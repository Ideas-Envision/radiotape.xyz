<?php

abstract class IdEnController
	{
		protected $vView;
		
		public function __construct()
			{
				$this->vView = new IdEnView(new IdEnRequest);
			}
		
		abstract public function index();/* OBLIGA A TODAS LAS CLASES HEREDADAS DE LA MISMA IMPLEMENTEN UN METODO INDEX CON O SIN CODIGO */
		
		protected function LoadModel($vModel)
			{
				$vModel = $vModel.'Model';
				$vRouteModel = ROOT_APPLICATION.'models'.DIR_SEPARATOR.$vModel.'.php';
				
				if(is_readable($vRouteModel))
					{
						require_once $vRouteModel;
						$vModel = new $vModel;
						return $vModel;
					}
				else
					{
						throw new Exception($vModel.' - No Existe el Modelo!');
						//header('Location: '.BASE_VIEW_URL.'error/model/1005');
						exit;						
					}
			}
        
		protected function getLibrary($vLibrary)
			{
				$vRouteLibrary = ROOT_APPLICATION.'libs'.DIR_SEPARATOR.$vLibrary.'.php';
				
				if(is_readable($vRouteLibrary))
					{
						require_once $vRouteLibrary;
					}
				else
					{
						throw new Exception($vLibrary.' - No Existe la Libreria!');
					}
			}        
		
		protected function redirect($vRoute = FALSE)
			{
				if($vRoute)
					{
						header('Location:'.BASE_VIEW_URL.$vRoute);
						exit;								
					}
				else
					{
						header('Location:'.BASE_VIEW_URL);					
						exit;						
					}
			}
    
        /* BEGIN VALIDADORES EN FUNCIONES GLOBALES - PÚBLICAS */
        public function stringLength($vString){
            
                $vNumCharacters = 0;
                $vNumCharacters = strlen($vString);

                return $vNumCharacters;
            
            }
    
        public function userNameValid($vString){
                
                if(ereg('^[a-zA-Z0-9]{3,20}$', $vString)){
                    //echo "El nombre de usuario $nombre_usuario es correcto<br>";
                    return true;
                } else {
                    //echo "El nombre de usuario $nombre_usuario no es válido<br>";
                    return false;
                } 
            
            }    
    
        /* END VALIDADORES EN FUNCIONES GLOBALES - PÚBLICAS */
    
						
	}

?>
