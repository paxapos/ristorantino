<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array('Html', 'Form', 'Ajax', 'Jqm');
        
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
	function index() {
           
            $this->params['PaginateConditions'] = array();
            $condiciones = array();
            $descuentoMaximo = Configure::read('Mozo.descuento_maximo');
            $currentRole = $this->Session->read('Auth.User.role');
            if ( strtolower($currentRole) == 'mozo' && is_numeric( $descuentoMaximo ) ) {                
                $condiciones['OR'] = array(
                        "Descuento.porcentaje <= $descuentoMaximo",
                        'Descuento.porcentaje IS NULL'
                    );
            }
		if(!empty($this->data)){
			
			$pagCondiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
						if(!is_array($val))
							$condiciones[$modelo.".".$key." LIKE"] = '%'.$val.'%';
							$pagCondiciones[$modelo.".".$key] = $val;
				}
			}
			$this->Cliente->recursive = 0;
			$this->params['PaginateConditions'] = $pagCondiciones;
		}
		
		
		if(!empty($this->passedArgs) && empty($this->data)){ 
			$pagCondiciones = array();
			foreach($this->passedArgs as $campo=>$valor){
				if($campo == 'page' || $campo == 'sort' || $campo == 'direction'){ 
					continue;
				}
				$condiciones["$campo LIKE"] = '%'.$valor.'%';
				$pagCondiciones[$campo] = $valor;
				$this->data[$campo] = $valor;
				
			}
			$this->Cliente->recursive = 0;
                        
			$this->params['PaginateConditions'] = $pagCondiciones;
		 }   
                 $this->paginate['conditions'] = $condiciones;
 
                /* <- Esto es lo original -> */
                debug($this->paginate);
		$this->Cliente->recursive = 0;
		$this->set('clientes', $this->paginate());
                
	}

	function view($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cliente.', true));
			$this->redirect(array('action'=>'index'));
		}
                $this->Cliente->contain(array(
                    'Descuento',
                ));
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() {
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
		if (!empty($this->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.', true));
			}
		}
		$users = $this->Cliente->User->find('list',array('fields'=>array('User.nombre')));
		$descuentos = $this->Cliente->Descuento->find('list');
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');		
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
                $this->set('tipo_documentos', $tipo_documentos);
                $this->set('iva_responsabilidades', $iva_responsabilidades);
		$this->set(compact('users', 'descuentos'));
	}

        function addFacturaA() {
            $this->pageTitle = 'Agregar Factura A';
		if (!empty($this->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente', true));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.', true));
			}
                        $this->set('cliente_id', $this->Cliente->id);
                        $this->layout = false;
                        $this->render('/clientes/jqm_result');
		}
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');

		$this->set(compact('iva_responsabilidades', 'tipo_documentos'));
	}

	function edit($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cliente incorrecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cliente->saveAll($this->data)) {
				$this->Session->setFlash(__('El Cliente fue guardado', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser guardado.intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
		$users = $this->Cliente->User->find('list',array('fields'=>array('User.nombre')));
		$descuentos = $this->Cliente->Descuento->find('list');
		
                $tipo_documentos = $this->Cliente->TipoDocumento->find('list');		
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
                $this->set('tipo_documentos', $tipo_documentos);
                $this->set('iva_responsabilidades', $iva_responsabilidades);
                
		$this->set(compact('users', 'descuentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cliente invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->del($id)) {
			$this->Session->setFlash(__('Cliente eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
	}
        
        


        /**
	 * me busca clientes
	 *
	 */
	function ajax_buscador(){
		$this->Cliente->order = 'Cliente.nombre';
                
                if (!empty($this->data['Cliente']['busqueda']) || !empty($this->passedArgs)){
                    if (!empty($this->data['Cliente']['busqueda'])) {
                        $this->passedArgs['busqueda'] = strtolower($this->data['Cliente']['busqueda']);
                    }
                    $busqueda = $this->passedArgs['busqueda'];
                    
                    $this->paginate = array('conditions'=>array(
                        'OR' => array(
                            'lower(Cliente.nombre) LIKE' => "%$busqueda%",
                            'lower(Cliente.nrodocumento) LIKE' => "%$busqueda%",
                        )),
                        'limit'=> 4,
                        'contain' => array(
                                                'Descuento'
                                            ),
                    );
                    $this->set('clientes',$this->paginate());
                }
		
	}
        
        
         function jqm_clientes($tipo = 'todos'){
             $this->conHeader = false;
             $this->pageTitle = 'Listado de Clientes';
             $tipo = '';
             $clientes = array();
             switch ($tipo) {
                 case 'a':
                 case 'A':
                     $clientes = $this->Cliente->todosLosTipoA();
                     $tipo = 'a';
                     break;
                 case 'd':
                 case 'descuento':
                     $clientes = $this->Cliente->todosLosDeDescuentos();
                     $tipo = 'd';
                     break;
                 default:
                     $tipo = 't';
                         $clientes = $this->Cliente->todos();
                     break;
             }
            $this->layout = 'jqm' ;
            $this->set('tipo',$tipo);
            $this->set('clientes',$clientes);
        }
	
	
	/**
	 * me lista todos los clientes que sean del tipo Factura "A"
	 *
	 */
	function ajax_clientes_factura_a(){
		$this->set('clientes',$this->Cliente->todosLosTipoA());
	}
	
        /**
	 * me lista todos los clientes con descuento
	 *
	 */
	function ajax_clientes_con_descuento(){
		$this->set('clientes',$this->Cliente->todosLosDeDescuentos());
	}

}
?>
