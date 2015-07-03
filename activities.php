<?php
?>
<script>
	var Script = function () {


    /* initialize the external events
     -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    /* initialize the calendar
     -----------------------------------------------------------------*/

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({

        <? if(esMobil()){?>
        defaultView: 'basicDay',
        header: {
            left: '',
            center: '',
            right: 'prev,today,next,basicWeek,basicDay'
         },
        <?}else{?>
        header: {
             right: 'prev,next today',
             center: 'title',
             left: 'month,basicWeek,basicDay'
         },
        <?}?>
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }

        },
        events: [
            <?
            $query_actividades="SELECT ac.id as actividad_id, s.salon, ac.categoria_id, ac.actividad, ac.fecha_hora_inicio, ac.fecha_hora_fin FROM agendas as ag INNER JOIN actividades as ac on ac.id=ag.actividad_id INNER JOIN salones as s on s.id=ac.lugar where ag.usuario_id=".$_SESSION['usuario']['id']." and ag.tipo=1";
            $actividades=$bd->ExecuteE($query_actividades);
            foreach ($actividades as &$actividad){
                $yi=date("Y", strtotime($actividad['fecha_hora_inicio']));
                $mi=date("m", strtotime($actividad['fecha_hora_inicio']))-1;
                $di=date("d", strtotime($actividad['fecha_hora_inicio']));
                $hi=date("H", strtotime($actividad['fecha_hora_inicio']));
                $mii=date("i", strtotime($actividad['fecha_hora_inicio']));
                $yf=date("Y", strtotime($actividad['fecha_hora_fin']));
                $mf=date("m", strtotime($actividad['fecha_hora_fin']))-1;
                $df=date("d", strtotime($actividad['fecha_hora_fin']));
                $hf=date("H", strtotime($actividad['fecha_hora_fin']));
                $mif=date("i", strtotime($actividad['fecha_hora_fin']));
            ?>
            {
                title: '<?=$actividad["actividad"]?>, sede:  <?=$actividad["salon"]?>',
                start: new Date(<?=$yi?>, <?=$mi?>, <?=$di?>, <?=$hi?>, <?=$mii?>),
                end: new Date(<?=$yf?>, <?=$mf?>, <?=$df?>, <?=$hf?>, <?=$mif?>),
                allDay: false,
                rendering: 'eventBackgroundColor',
                color: '#ff9000',
                url: './?action=actividad&id=<?=$actividad["actividad_id"]?>&cat=<?=$actividad["categoria_id"]?>'
            },
            <?}?>
            <?
            $query_conferencias="SELECT con.actividad_id as actividad_id, sa.salon, con.id as conferencia_id, con.conferencia, con.fecha_hora_inicio, con.fecha_hora_fin FROM agendas as ag INNER JOIN conferencias as con on con.id=ag.actividad_id INNER JOIN actividades as ac on ac.id=con.actividad_id INNER JOIN salones as sa on sa.id=ac.lugar where ag.usuario_id=".$_SESSION['usuario']['id']." and ag.tipo=2";
            $conferencias=$bd->ExecuteE($query_conferencias);
            foreach ($conferencias as &$conferencia){
                $yi=date("Y", strtotime($conferencia['fecha_hora_inicio']));
                $mi=date("m", strtotime($conferencia['fecha_hora_inicio']))-1;
                $di=date("d", strtotime($conferencia['fecha_hora_inicio']));
                $hi=date("H", strtotime($conferencia['fecha_hora_inicio']));
                $mii=date("i", strtotime($conferencia['fecha_hora_inicio']));
                $yf=date("Y", strtotime($conferencia['fecha_hora_fin']));
                $mf=date("m", strtotime($conferencia['fecha_hora_fin']))-1;
                $df=date("d", strtotime($conferencia['fecha_hora_fin']));
                $hf=date("H", strtotime($conferencia['fecha_hora_fin']));
                $mif=date("i", strtotime($conferencia['fecha_hora_fin']));
            ?>
            {
                title: '<?=$conferencia["conferencia"]?>, sede:  <?=$conferencia["salon"]?>',
                start: new Date(<?=$yi?>, <?=$mi?>, <?=$di?>, <?=$hi?>, <?=$mii?>),
                end: new Date(<?=$yf?>, <?=$mf?>, <?=$df?>, <?=$hf?>, <?=$mif?>),
                allDay: false,
                url: './?action=actividad&id=<?=$conferencia["actividad_id"]?>&conf'
            },
            <?}?>
        ]
    });


}();

</script>