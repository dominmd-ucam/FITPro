<?php
session_start();

function home(){
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    $resultado = $entrenadores->getEntrenadores();

    $html = '';
    while($row = $resultado->fetch_assoc()) {
        $html .= '<tr class="border-t border-t-[#344c65]">';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">' . $row['nombre'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['email'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['telefono'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">';
        $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
        $html .= '<span class="truncate">' . $row['especialidad'] . '</span>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600 h-[72px] px-4 py-2 w-60 text-[#93adc8] text-sm font-bold leading-normal tracking-[0.015em]">Edit</td>';
        $html .= '</tr>';
    }

    require_once("view/entrenadores_view.php");
}

function desconectar(){
    session_destroy();
    header("Location: index.php");
}
?>