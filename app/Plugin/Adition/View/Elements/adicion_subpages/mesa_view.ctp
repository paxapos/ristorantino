<?php echo $this->Html->script('/adition/js/adicion/elements/mesa_view'); ?>
<div data-role="page" id="mesa-view">
	<div  data-role="header" data-bind="css: {'ui-bar-f': adn().currentMesa().estaCerrada()}">
            <a href="#listado-mesas" data-direction="reverse">Volver</a>
            <h1>
                <span data-bind="text: adn().currentMesa().numero()"></span>
                <?php 
                echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') ." - " .
                Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png') 
                ?>
                <span data-bind="text: adn().currentMesa().mozo().numero()"></span>
                 
                <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
            </h1>
        </div>

        <div  data-role="content" class="" data-scroll="true">
            
            <div class="mesa-actions">
                
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a data-role="button"id="mesa-action-comanda" href="#comanda-add-menu" data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().estado().icon}">
                                    <?= $this->Html->image('/adition/css/img/chef_64.png')?><br>
                                    Comanda
                        </a>
                    </div>
                    
                    <div class="ui-block-b">
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-cerrar_'+adn().currentMesa().estado().icon}" href="#listado-mesas" id="mesa-cerrar" data-direction="reverse">
                                    <?= $this->Html->image('/adition/css/img/cerrarmesa.png')?><br>
                                Cerrar
                        </a>
                    </div>
                </div>
                
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a data-role="button" id="mesa-action-cobrar" href="#mesa-cobrar" data-bind="attr: {'estado': 'mesa-cobrar_'+adn().currentMesa().estado().icon}">
                                    <?= $this->Html->image('/adition/css/img/cobrar.png')?><br>
                                Cobrar
                        </a>
                    </div>
                    
                    <div class="ui-block-b">
                        <a id="mesa-reabrir" href="#listado-mesas" data-role="button" data-bind="attr: {'estado': 'mesa-reabrir_'+adn().currentMesa().estado().icon}">
                                <?= $this->Html->image('/adition/css/img/reabrir.png')?><br>
                                Re Abrir
                        </a>
                    </div>
                </div>
                
                
                <div  data-bind="attr: {'estado': adn().currentMesa().estado().icon}" class="ui-grid-a">
                    
                    <div class="ui-block-a">
                        <a data-role="button"href="<?php echo $this->Html->url('/clientes/all_clientes.jqm')?>" data-rel="dialog" data-bind="attr: {'estado': 'mesa-cliente_'+adn().currentMesa().estado().icon}">
                                <?= $this->Html->image('/adition/css/img/customers.png')?><br>
                            <span data-bind="visible: !adn().currentMesa().Cliente()">Cliente</span>
                            <span data-bind="visible: adn().currentMesa().Cliente()" style="white-space: normal"><span data-bind="text: adn().currentMesa().clienteNameData()"></span></span>
                        </a>
                    
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-re-print_'+adn().currentMesa().estado().icon}" href="#listado-mesas" class="mesa-reimprimir"  data-rel="back">
                                <?= $this->Html->image('/adition/css/img/printer.png')?><br>
                                Imprimir Ticket
                        </a>
                        
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="#listado-mesas" id="mesa-borrar" data-rel="back">
                                        <?= $this->Html->image('/adition/css/img/borrarmesa.png')?><br>
                                        Borrar
                        </a>
                        
                    </div>
                    
                    <div class="ui-block-b">
                        <a data-role="button"id="mesa-action-descuento" data-bind="attr: {'estado': 'mesa-cliente_'+adn().currentMesa().estado().icon}" href="<?php echo $this->Html->url('/descuentos/all_descuentos.jqm')?>" data-rel="dialog">
                                <?= $this->Html->image('/adition/css/img/descuento.png')?><br>
                            <span>Descuento</span>
                            <span style="white-space: normal"><span data-bind="text: adn().currentMesa().Descuento().porcentaje"></span></span>
                        </a>
                        
                        
                        <a data-role="button"id="mesa-action-menu" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="#mesa-menu" data-rel="dialog">
                                        <?= $this->Html->image('/adition/css/img/menu.png')?><br>
                                         <span style="color: red" data-bind="visible: adn().currentMesa().menu() != 0,text: adn().currentMesa().menu"></span> Menú
                        </a>
                       
                        <a data-role="button" id="mesa-action-edit" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="<? echo $this->Html->url('/mesas/edit/') ?>"  data-href="<? echo $this->Html->url('/mesas/edit/') ?>">
                                <?= $this->Html->image('/adition/css/img/editarmesa.png')?><br>
                            Editar
                        </a>

                    </div>
                </div>
                    
                <div class="ui-grid-b">
                    <div class="ui-block-a">
                        <a data-role="button"id="mesa-action-cambiar-mozo" href="#mesa-cambiar-mozo" data-rel="dialog">
                            <?= $this->Html->image('/adition/css/img/cambiarmozo.png')?><br>
                            <?php echo Configure::read('Mesa.tituloMozo')?>
                        </a>
                    </div>

                    <div class="ui-block-b">
                        <a data-role="button"id="mesa-action-cambiar-numero" href="#mesa-cambiar-numero" data-rel="dialog">
                                    <?= $this->Html->image('/adition/css/img/cambiarmesa.png')?><br>
                                    Número
                        </a>
                    </div>

                    <div class="ui-block-c">
                        <a data-role="button" id="mesa-action-cambiar-cubiertos" href="#mesa-cambiar-cubiertos" data-rel="dialog">
                            <span style="top: -19px;position: absolute;left: 50%;margin-left: -25%;" data-bind="visible: adn().currentMesa().cant_comensales() > 0"><span data-bind="text: adn().currentMesa().cant_comensales()"></span></span>
                            <?= $this->Html->image('/adition/css/img/cambiarcubiertos.png')?><br>
                            <span>Cubiertos</span>                            
                        </a>
                    </div>

                </div>
                     
            </div>

            <div class="mesa-view">
                <h3 class="titulo-comanda">Listado de Comandas</h3>

                <!-- @template listaComandas -->
                <div id="comanda-detalle-collapsible" data-role="collapsible-set"
                     data-bind="template: {name: 'listaComandas', foreach: adn().currentMesa().Comanda}"></div>
            </div>
            
        </div>
    
    <div data-role="footer" data-position="fixed">
        <h3>
            <span class="mesa-id" style="float: left;">
                    #<span data-bind="text: adn().currentMesa().id()"></span>
                    <span data-bind="visible: !adn().currentMesa().id()">
                        <?php echo $this->Html->image('loader.gif'); ?>
                    </span>
            </span>
            <span class="mesa-total"><span data-bind="text: adn().currentMesa().textoTotalCalculado()"></span></span>
            <span class="hora-abrio">Abrió a las <span data-bind="text: adn().currentMesa().timeCreated()"></span></span>
        </h3>
    </div>
</div>