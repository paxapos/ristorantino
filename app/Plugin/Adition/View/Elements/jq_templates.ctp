<!-- Template: listado de comandas con sus productos-->
<script id="listaComandas" type="text/x-jquery-tmpl">
   <div data-role="collapsible" data-content-theme="c">
       <h3>
           <span class="id-comanda">#<span data-bind="text: id()"></span></span>  <span class="hora-comanda"  data-bind="text: timeCreated()"></span>&nbsp;&nbsp;&nbsp;
           <span class="comanda-listado-productos-string" data-bind="text: productsStringListing()"></span>
           
           <a style="float: right;" href="#" data-bind="click: imprimirComanda" class="btn-comanda-icon">
               imprimir
           </a>
       </h3>

       <!-- @template li-productos-detallecomanda -->
        <ul class="comanda-items" data-role="listview"
           data-bind="template: {name: 'li-productos-detallecomanda', foreach: DetalleComanda}"
           style="margin: 0px;">

        </ul>                                                                           
   </div>
</script>




<!-- Template: Listado de productos del detalle Comanda -->
<script id="li-productos-detallecomanda" type="text/x-jquery-tmpl">
 <li class="ui-li ui-li-static ui-btn-up-c ui-li-last">
     <div data-type="horizontal"  data-mini="true" data-role="controlgroup" style="float: left">
        <a id="mesa-action-detalle-comanda-sacar-item" data-bind="click: deseleccionarYEnviar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c">-</a>
        <a data-bind="css: { es_entrada: esEntrada()}" data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c">
            Entrada
        </a>
     </div>

     <span class="producto-cant" data-bind="text: realCant()" style="padding-left: 20px;"></span>
     <span class="producto-nombre" data-bind="text: nameConSabores() + ' ' +observacion(), css: {tachada: realCant()==0}" style="padding-left: 20px;"></span>
     <span class="producto-precio">p/u: {{= '$'}}<span data-bind="text: precio()"></span></span>
 </li>
</script>



 
 <!-- Template: Comanda Add menu path-->
 <script id="boton" type="text/x-jquery-tmpl">
        <a data-bind="attr: {
                         'data-icon': esUltimoDelPath()?'':'back', 
                         'css': {'ui-btn-active': esUltimoDelPath()}
                         }, 
                      click: seleccionar" 
            class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
             <span class="ui-btn-inner ui-btn-corner-all">
                 <span class="ui-btn-text" data-bind="text: name" ></span>
                 <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
             </span>
         </a>
</script>


 

<!-- listado de pagos seleccionados -->
<script id="li-pagos-creados" type="text/x-jquery-tmpl">
     <li>
         <img src="" data-bind="attr: {src: image(), alt: TipoDePago().name, title: TipoDePago().name}"/>
         <label>Ingresar Valor $: </label>
         <input name="valor" data-bind="value: valor, valueUpdate: 'keyup'" placeholder="Ej: 100.4"/>
     </li>
</script>




<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'id': 'mesa-li-id-'+id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-role="button" 
            href="#mesa-view" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-span ui-btn-inner">
                <span class="ui-btn-text">
                    <span class="mesa-numero" data-bind="text: numero"></span>
                    
                </span>
            </span>
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                "<span data-bind="text: clienteTipoFacturaText()"></span>"
            </span>
            <span class="mesa-time" data-bind="text: textoHora()"></span>
        </a>
    </li>
</script>


<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
es igual al de las mesas de la adicion salvo que al hacer click tienen otro comportamiento
-->
<script id="listaMesasCajero" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-rel="dialog"
            data-role="button" 
            data-transition="none"
            data-icon="none"
            href="#mesa-cobrar" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                "<span data-bind="text: clienteTipoFacturaText()"></span>"
            </span>
            
            <span class="mesa-numero" data-bind="text: numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            
            <br />
            <br />
            <span class="mesa-total">$ <span data-bind="text: totalCalculado()"></span></span><br />
            
            
            <span class="mesa-time" data-bind="text: textoHora()"></span>
        </a>
    </li>
</script>




<!-- Template: Comanda Add, Listado de sabores de categorias       -->
<script id="listaSabores" type="text/x-jquery-tmpl">
   <a href="#" data-theme="c" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
       <span class="ui-btn-inner ui-btn-corner-all">
           <span class="ui-btn-text">
               <span data-bind="text: name"></span>                         
           </span>
       </span>
   </a>
</script>


