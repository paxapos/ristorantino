<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('estado_id'); ?></th>
        <th><?php echo $this->Paginator->sort('numero'); ?></th>
        <th><?php echo $this->Paginator->sort('Mozo.numero', 'Nº de Mozo'); ?></th>
        <th><?php echo $this->Paginator->sort('total'); ?></th>
        <th>Descuento</th>
        <th><?php echo $this->Paginator->sort('cant_comensales', 'Cubiertos'); ?></th>
        <th>
            <?php echo $this->Paginator->sort('created', 'Fecha Abrió'); ?><br />
        </th>
        <th>
            <?php echo $this->Paginator->sort('time_cerro', 'Fecha Cerró'); ?><br />
        </th>
        <th>
            <?php echo $this->Paginator->sort('time_cobro', 'Fecha Cobró'); ?><br />
        </th>
        <th>Factura</th>
        <th><?php echo $this->Paginator->sort('Cliente.nombre', 'Cliente'); ?></th>


        <th class="actions"><?php echo __('Acciones'); ?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($mesa as $mesa):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
        <tr<?php echo $class; ?>>
            <td>
                <strong><?php echo $estados[$mesa['Mesa']['estado_id']]; ?><strong>
                        </td>

                        <td>
                            <strong><?php echo $mesa['Mesa']['numero']; ?><strong>
                                    </td>
                                    <td>
                                        <?php echo $this->Html->link('N° ' . $mesa['Mozo']['numero'], '/Mozos/view/' . $mesa['Mesa']['mozo_id']); ?>
                                    </td>
                                    <td>
                                        <?php echo $mesa['Mesa']['total']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($mesa['Cliente']['Descuento']['porcentaje'])) {
                                            echo $mesa['Cliente']['Descuento']['porcentaje'] . "%";
                                        } else {
                                            echo '0%';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $mesa['Mesa']['cant_comensales'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($mesa['Mesa']['created'] != '0000-00-00 00:00:00') {
                                            echo date('d-m-y (H:i)', strtotime($mesa['Mesa']['created']));
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($mesa['Mesa']['time_cerro'] != '0000-00-00 00:00:00') {
                                            echo date('d-m-y (H:i)', strtotime($mesa['Mesa']['time_cerro']));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($mesa['Mesa']['time_cobro'] != '0000-00-00 00:00:00') {
                                            echo date('d-m-y (H:i)', strtotime($mesa['Mesa']['time_cobro']));
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        if (!empty($mesa['Cliente']['Descuento']['porcentaje'])) {
                                            echo 'remito';
                                        } elseif ($mesa['Cliente']['tipofactura']) {
                                            echo ' "' . $mesa['Cliente']['tipofactura'] . '"';
                                        }
                                        else
                                            echo ' "B"'
                                            ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($mesa['Cliente'])) {
                                            echo $mesa['Cliente']['nombre'];
                                        }
                                        ?>
                                    </td>

                                    <td class="actions">
                                        <?php
                                        if ($mesa['Mesa']['estado_id'] != MESA_ABIERTA) {
                                            echo $this->Html->link(__('Reabrir'), array('action' => 'reabrir', $mesa['Mesa']['id'], 'admin' => ''));
                                            echo ('</br>');
                                        }
                                        ?>

                                        <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $mesa['Mesa']['id'])); ?>
                                        </br>
                                    <?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $mesa['Mesa']['id']), null, sprintf(__('¿Esta seguro que quiere borrar la mesa nº %s?\nSi se elimina se perderán los pedidos y no sera computada en las estadísticas.'), $mesa['Mesa']['numero'])); ?>
                                        </br>
    <?php echo $this->Html->link(__('Imprimir Ticket'), array('action' => 'imprimirTicket', $mesa['Mesa']['id'], 'admin' => false), null, sprintf(__('¿Desea imprimir el ticket de la mesa nº %s?'), $mesa['Mesa']['numero'])); ?>
                                    </td>
                                    </tr>
<?php endforeach; ?>      
                                </table>