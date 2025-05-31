<?php
require_once("controller/front_controller.php");

// Verificar si el usuario está logueado
if (!verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <title>Classes view Admin</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <!-- JSZip para Excel -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- PDFMake para PDF -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- Botones de exportación -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <style>
      @media (max-width: 768px) {
        .layout-content-container {
          margin-left: 0 !important;
          width: 100%;
        }
        .sidebar-container {
          display: none;
          position: absolute;
          top: 1rem;
          left: 1rem;
          width: 280px;
          height: auto;
          max-height: 90vh;
          z-index: 1000;
          background-color: #e7edf4;
          border-radius: 1rem;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          overflow-y: auto;
        }
        .sidebar-container.active {
          display: block;
        }
        .hamburger-menu {
          display: flex !important;
          align-items: center;
          justify-content: center;
          position: absolute;
          top: 1rem;
          right: 1rem;
          z-index: 1001;
          background: #0c77f2;
          padding: 0.75rem;
          border-radius: 0.5rem;
          color: white;
          width: 40px;
          height: 40px;
          cursor: pointer;
          border: none;
          box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .hamburger-menu i {
          font-size: 20px;
        }
        .overlay {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 999;
        }
        .overlay.active {
          display: block;
        }
      }
      .hamburger-menu {
        display: none;
      }
      .content-margin-left {
        margin-left: 320px;
      }
      @media (max-width: 768px) {
        .content-margin-left {
          margin-left: 0 !important;
        }
      }
      
      body {
        background-color: #dce5ef;
      }
      
      .main-card {
        background-color: #f8fafc;
        border-radius: 1.5rem;
        margin: 2rem auto;
        max-width: 1600px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        position: relative;
      }
      
      .main-content {
        display: flex;
        position: relative;
        min-height: 100vh;
      }
      
      .sidebar-container {
        width: 320px;
        padding: 2rem 1rem;
        background-color: #f8fafc;
        z-index: 1000;
      }
      
      .sidebar-inner {
        background-color: #e7edf4;
        border-radius: 1rem;
        height: 100%;
        padding: 1rem;
        position: relative;
        z-index: 1000;
      }
      
      .content-container {
        flex: 1;
        padding: 2rem 1rem;
        position: relative;
      }
      
      @media (max-width: 1650px) {
        .main-card {
          margin: 1rem;
        }
      }
      
      @media (max-width: 1024px) {
        .sidebar-container {
          display: none;
        }
        
        .sidebar-container.active {
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          z-index: 1000;
        }
        
        .content-container {
          margin-left: 0;
        }
      }

      /* DataTables Custom Styling */
      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter,
      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_processing,
      .dataTables_wrapper .dataTables_paginate {
          color: #49709c;
          margin: 1rem 0;
          padding: 0 2rem;
      }

      /* Estilos para el texto de la tabla */
      #classesTable td {
          color: #0d141c !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button {
          color: #49709c !important;
          background: #e7edf4 !important;
          border: none !important;
          border-radius: 0.75rem;
          padding: 0.5rem 1rem;
          margin: 0 0.25rem;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button.current {
          background: #49709c !important;
          color: white !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
          background: #49709c !important;
          color: white !important;
      }

      .dataTables_wrapper .dataTables_filter input {
          background: #e7edf4;
          border: none;
          border-radius: 0.75rem;
          padding: 0.5rem 1rem;
          color: #0d141c;
      }

      .dataTables_wrapper .dataTables_length select {
          background: #e7edf4;
          border: none;
          border-radius: 0.75rem;
          padding: 0.5rem 1rem;
          color: #0d141c;
          margin-left: 0.5rem;
      }

      /* Estilos para los botones de exportación */
      .dt-buttons .dt-button {
          background: #49709c !important;
          color: white !important;
          border: none !important;
          border-radius: 0.75rem !important;
          padding: 0.5rem 1rem !important;
          margin: 0 0.25rem !important;
          font-size: 0.875rem !important;
      }

      .dt-buttons .dt-button:hover {
          background: #0c77f2 !important;
          color: white !important;
      }

      .dt-button-collection {
          background: white !important;
          border: 1px solid #49709c !important;
          border-radius: 0.75rem !important;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
      }

      .dt-button-collection .dt-button {
          background: white !important;
          color: #49709c !important;
          border: none !important;
          padding: 0.5rem 1rem !important;
      }

      .dt-button-collection .dt-button:hover {
          background: #49709c !important;
          color: white !important;
      }

      /* Ajuste del contenedor de la tabla */
      .flex.overflow-hidden.rounded-xl.border {
          margin: 0 2rem;
      }

      /* Ajuste del espaciado de las celdas */
      #classesTable td, 
      #classesTable th {
          padding: 1rem 2rem !important;
      }

      /* Estilos para los bordes de las filas */
      #classesTable tbody tr {
          border-bottom: 2px solid #e7edf4 !important;
      }

      #classesTable tbody tr:last-child {
          border-bottom: none !important;
      }

      #classesTable tbody tr:hover {
          background-color: #f8fafc !important;
      }

      /* Asegurar que las celdas tengan bordes */
      #classesTable td {
          border-bottom: 1px solid #e7edf4 !important;
      }

      #classesTable td:last-child {
          border-right: none !important;
      }

      /* Ajuste del espaciado de los controles */
      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter {
          margin-bottom: 1.5rem;
      }

      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_paginate {
          margin-top: 1.5rem;
      }

      /* Ajuste del espaciado de los botones */
      .dt-buttons {
          margin-bottom: 1rem;
          padding: 0 2rem;
      }

      /* Estilos para el modal */
      .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.5);
      }

      .modal-content {
          background-color: #f8fafc;
          margin: 5% auto;
          padding: 2rem;
          border-radius: 1rem;
          width: 500px;
          position: relative;
      }

      .close {
          color: #49709c;
          float: right;
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
      }

      .close:hover {
          color: #0c77f2;
      }

      .form-group {
          margin-bottom: 1rem;
      }

      .form-group label {
          display: block;
          color: #0d141c;
          margin-bottom: 0.5rem;
          font-size: 0.875rem;
          font-weight: 500;
      }

      .form-group input,
      .form-group select,
      .form-group textarea {
          width: 100%;
          padding: 0.5rem 1rem;
          border-radius: 0.75rem;
          background-color: #e7edf4;
          border: none;
          color: #0d141c;
          font-size: 0.875rem;
      }

      .form-group textarea {
          height: 6rem;
          resize: vertical;
      }

      .form-actions {
          display: flex;
          justify-content: flex-end;
          gap: 1rem;
          margin-top: 1.5rem;
      }

      .btn {
          padding: 0.5rem 1rem;
          border-radius: 0.75rem;
          font-size: 0.875rem;
          font-weight: 500;
          cursor: pointer;
      }

      .btn-primary {
          background-color: #49709c;
          color: white;
      }

      .btn-primary:hover {
          background-color: #0c77f2;
      }

      .btn-secondary {
          background-color: #e7edf4;
          color: #0d141c;
      }

      .btn-secondary:hover {
          background-color: #dce5ef;
      }

      /* Estilos para los botones de acción */
      .edit-class-btn svg,
      .text-red-500 svg {
          width: 20px;
          height: 20px;
          stroke: currentColor;
      }

      .edit-class-btn {
          color: #49709c;
          padding: 0.5rem;
          border-radius: 0.5rem;
          transition: all 0.2s;
      }

      .edit-class-btn:hover {
          background-color: #e7edf4;
          color: #0c77f2;
      }

      .text-red-500 {
          padding: 0.5rem;
          border-radius: 0.5rem;
          transition: all 0.2s;
      }

      .text-red-500:hover {
          background-color: #fee2e2;
      }

      /* Estilos para el modal de edición */
      .form-group {
          margin-bottom: 1rem;
      }

      .form-group label {
          display: block;
          color: #0d141c;
          margin-bottom: 0.5rem;
          font-size: 0.875rem;
          font-weight: 500;
      }

      .form-group input,
      .form-group select,
      .form-group textarea {
          width: 100%;
          padding: 0.5rem 1rem;
          border-radius: 0.75rem;
          background-color: #e7edf4;
          border: none;
          color: #0d141c;
          font-size: 0.875rem;
      }

      .form-group textarea {
          height: 6rem;
          resize: vertical;
      }

      .form-actions {
          display: flex;
          justify-content: flex-end;
          gap: 1rem;
          margin-top: 1.5rem;
      }

      .btn {
          padding: 0.5rem 1rem;
          border-radius: 0.75rem;
          font-size: 0.875rem;
          font-weight: 500;
          cursor: pointer;
      }

      .btn-primary {
          background-color: #49709c;
          color: white;
      }

      .btn-primary:hover {
          background-color: #0c77f2;
      }

      .btn-secondary {
          background-color: #e7edf4;
          color: #0d141c;
      }

      .btn-secondary:hover {
          background-color: #dce5ef;
      }

      .close {
          color: #49709c;
          float: right;
          font-size: 28px;
          font-weight: bold;
          cursor: pointer;
      }

      .close:hover {
          color: #0c77f2;
      }
    </style>
  </head>
  <body>
    <div class="main-card">
      <div class="overlay" onclick="toggleSidebar()"></div>
      <button type="button" class="hamburger-menu" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </button>
      
      <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar-container">
          <div class="sidebar-inner">
            <div class="flex h-full min-h-[700px] flex-col justify-between p-4">
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="House" data-size="24px" data-weight="fill">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=home&action=home">Dashboard</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Users" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=miembros&action=home">Miembros</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="User" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=entrenadores&action=home">Entrenadores</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#49709c]">
                    <div class="text-white" data-icon="UsersThree" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=clases&action=home">Clases</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="File" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Incidencias</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <button id="newClassBtn" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#0c77f2] text-white text-sm font-bold leading-normal tracking-[0.015em]">
                  <span class="truncate">Nueva clase</span>
                </button>
                <div class="flex flex-col gap-1">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Gear" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Zm88-29.84q.06-2.16,0-4.32l14.92-18.64a8,8,0,0,0,1.48-7.06,107.21,107.21,0,0,0-10.88-26.25,8,8,0,0,0-6-3.93l-23.72-2.64q-1.48-1.56-3-3L186,40.54a8,8,0,0,0-3.94-6,107.71,107.71,0,0,0-26.25-10.87,8,8,0,0,0-7.06,1.49L130.16,40Q128,40,125.84,40L107.2,25.11a8,8,0,0,0-7.06-1.48A107.6,107.6,0,0,0,73.89,34.51a8,8,0,0,0-3.93,6L67.32,64.27q-1.56,1.49-3,3L40.54,70a8,8,0,0,0-6,3.94,107.71,107.71,0,0,0-10.87,26.25,8,8,0,0,0,1.49,7.06L40,125.84Q40,128,40,130.16L25.11,148.8a8,8,0,0,0-1.48,7.06,107.21,107.21,0,0,0,10.88,26.25,8,8,0,0,0,6,3.93l23.72,2.64q1.49,1.56,3,3L70,215.46a8,8,0,0,0,3.94,6,107.71,107.71,0,0,0,26.25,10.87,8,8,0,0,0,7.06-1.49L125.84,216q2.16.06,4.32,0l18.64,14.92a8,8,0,0,0,7.06,1.48,107.21,107.21,0,0,0,26.25-10.88,8,8,0,0,0,3.93-6l2.64-23.72q1.56-1.48,3-3L215.46,186a8,8,0,0,0,6-3.94,107.71,107.71,0,0,0,10.87-26.25,8,8,0,0,0-1.49-7.06Zm-16.1-6.5a73.93,73.93,0,0,1,0,8.68,8,8,0,0,0,1.74,5.48l14.19,17.73a91.57,91.57,0,0,1-6.23,15L187,173.11a8,8,0,0,0-5.1,2.64,74.11,74.11,0,0,1-6.14,6.14,8,8,0,0,0-2.64,5.1l-2.51,22.58a91.32,91.32,0,0,1-15,6.23l-17.74-14.19a8,8,0,0,0-5-1.75h-.48a73.93,73.93,0,0,1-8.68,0,8,8,0,0,0-5.48,1.74L100.45,215.8a91.57,91.57,0,0,1-15-6.23L82.89,187a8,8,0,0,0-2.64-5.1,74.11,74.11,0,0,1-6.14-6.14,8,8,0,0,0-5.1-2.64L46.43,170.6a91.32,91.32,0,0,1-6.23-15l14.19-17.74a8,8,0,0,0,1.74-5.48,73.93,73.93,0,0,1,0-8.68,8,8,0,0,0-1.74-5.48L40.2,100.45a91.57,91.57,0,0,1,6.23-15L69,82.89a8,8,0,0,0,5.1-2.64,74.11,74.11,0,0,1,6.14-6.14A8,8,0,0,0,82.89,69L85.4,46.43a91.32,91.32,0,0,1,15-6.23l17.74,14.19a8,8,0,0,0,5.48,1.74,73.93,73.93,0,0,1,8.68,0,8,8,0,0,0,5.48-1.74L155.55,40.2a91.57,91.57,0,0,1,15,6.23L173.11,69a8,8,0,0,0,2.64,5.1,74.11,74.11,0,0,1,6.14,6.14,8,8,0,0,0,5.1,2.64l22.58,2.51a91.32,91.32,0,0,1,6.23,15l-14.19,17.74A8,8,0,0,0,199.87,123.66Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Ajustes</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Ayuda &amp; feedback</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#0d141c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8"></path>
                        <path d="M7 12h10M7 12l4-4M7 12l4 4"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=clases&action=desconectar">Cerrar Sesion</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Content -->
        <div class="content-container">
          <div class="flex flex-wrap justify-between gap-3 p-4">
            <p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight min-w-72">Clases</p>
          </div>
          
          <div class="px-4 py-3">
            <div class="flex w-full flex-1 items-stretch rounded-xl h-12">
              <div class="text-[#49709c] flex border-none bg-[#e7edf4] items-center justify-center pl-4 rounded-l-xl border-r-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                  <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                </svg>
              </div>
              <div class="dataTables_filter flex-1">
                <input type="search" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#0d141c] focus:outline-0 focus:ring-0 border-none bg-[#e7edf4] focus:border-none h-full placeholder:text-[#49709c] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Buscar clases por nombre, descripcion o entrenador">
              </div>
            </div>
          </div>
          
          <div class="px-4 py-3 @container">
            <div class="flex overflow-hidden rounded-xl border border-[#49709c] bg-[#f8fafc]">
              <table id="classesTable" class="flex-1">
                <thead>
                  <tr class="bg-[#e7edf4]">
                    <th class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120 px-4 py-3 text-left text-[#0d141c] w-[400px] text-sm font-medium leading-normal">Nombre</th>
                    <th class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240 px-4 py-3 text-left text-[#0d141c] w-[400px] text-sm font-medium leading-normal">Descripcion</th>
                    <th class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360 px-4 py-3 text-left text-[#0d141c] w-[400px] text-sm font-medium leading-normal">
                      Entrenador
                    </th>
                    <th class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480 px-4 py-3 text-left text-[#0d141c] w-60 text-sm font-medium leading-normal">Horario</th>
                    <th class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600 px-4 py-3 text-left text-[#0d141c] w-60 text-[#49709c] text-sm font-medium leading-normal">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $html; ?>
                </tbody>
              </table>
            </div>
            <style>
              @container(max-width:120px){.table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120{display: none;}}
              @container(max-width:240px){.table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240{display: none;}}
              @container(max-width:360px){.table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360{display: none;}}
              @container(max-width:480px){.table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480{display: none;}}
              @container(max-width:600px){.table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600{display: none;}}
            </style>
            <script>
              $(document).ready(function() {
                  var table = $('#classesTable').DataTable({
                      dom: '<"flex justify-between items-center"lB>rt<"flex justify-between items-center"ip>',
                      buttons: [
                          {
                              extend: 'collection',
                              text: 'Exportar',
                              className: 'export-buttons',
                              buttons: [
                                  {
                                      extend: 'csv',
                                      text: 'CSV',
                                      className: 'export-button',
                                      exportOptions: {
                                          columns: [0, 1, 2, 3]
                                      }
                                  },
                                  {
                                      extend: 'excel',
                                      text: 'Excel',
                                      className: 'export-button',
                                      exportOptions: {
                                          columns: [0, 1, 2, 3]
                                      }
                                  },
                                  {
                                      extend: 'pdf',
                                      text: 'PDF',
                                      className: 'export-button',
                                      exportOptions: {
                                          columns: [0, 1, 2, 3]
                                      }
                                  },
                                  {
                                      extend: 'print',
                                      text: 'Imprimir',
                                      className: 'export-button',
                                      exportOptions: {
                                          columns: [0, 1, 2, 3]
                                      }
                                  }
                              ]
                          }
                      ],
                      language: {
                          search: "",
                          searchPlaceholder: "Search classes by name, description or trainer",
                          lengthMenu: "Mostrar _MENU_ entradas",
                          info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                          paginate: {
                              first: "First",
                              last: "Last",
                              next: "Siguiente",
                              previous: "Anterior"
                          },
                          buttons: {
                              collection: "Exportar <span class='caret'></span>"
                          }
                      },
                      pageLength: 10,
                      ordering: true,
                      responsive: true
                  });

                  // Conectar el input personalizado con DataTables
                  $('.dataTables_filter input').off().on('keyup', function() {
                      table.search(this.value).draw();
                  });
              });
            </script>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para crear clase -->
    <div id="newClassModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[9999]">
      <div class="bg-[#f8fafc] rounded-xl p-6 w-[500px] relative">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-[#0d141c] text-xl font-bold">Nueva Clase</h2>
          <button id="closeModal" class="text-[#49709c] hover:text-[#0c77f2]">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
              <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
            </svg>
          </button>
        </div>
        <form id="newClassForm" class="space-y-4">
          <div>
            <label for="nombre" class="block text-[#0d141c] text-sm font-medium mb-2">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c]" required>
          </div>
          <div>
            <label for="descripcion" class="block text-[#0d141c] text-sm font-medium mb-2">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c] h-24" required></textarea>
          </div>
          <div>
            <label for="entrenador_id" class="block text-[#0d141c] text-sm font-medium mb-2">Entrenador</label>
            <select id="entrenador_id" name="entrenador_id" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c]" required>
              <option value="">Seleccionar entrenador</option>
            </select>
          </div>
          <div>
            <label for="dia_semana" class="block text-[#0d141c] text-sm font-medium mb-2">Día de la semana</label>
            <select id="dia_semana" name="dia_semana" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c]" required>
              <option value="">Seleccionar día</option>
              <option value="Lunes">Lunes</option>
              <option value="Martes">Martes</option>
              <option value="Miércoles">Miércoles</option>
              <option value="Jueves">Jueves</option>
              <option value="Viernes">Viernes</option>
              <option value="Sábado">Sábado</option>
              <option value="Domingo">Domingo</option> 
            </select>
          </div>
          <div>
            <label for="hora_inicio" class="block text-[#0d141c] text-sm font-medium mb-2">Hora de inicio</label>
            <input type="time" id="hora_inicio" name="hora_inicio" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c]" required>
          </div>
          <div>
            <label for="hora_fin" class="block text-[#0d141c] text-sm font-medium mb-2">Hora de fin</label>
            <input type="time" id="hora_fin" name="hora_fin" class="w-full px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] border-none focus:outline-none focus:ring-2 focus:ring-[#49709c]" required>
          </div>
          <div class="flex justify-end gap-4 mt-6">
            <button type="button" id="cancelNewClass" class="px-4 py-2 rounded-xl bg-[#e7edf4] text-[#0d141c] hover:bg-[#dce5ef]">Cancelar</button>
            <button type="submit" class="px-4 py-2 rounded-xl bg-[#49709c] text-white hover:bg-[#0c77f2]">Crear Clase</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal de Edición -->
    <div id="editClassModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[9999]">
        <div class="bg-[#f8fafc] rounded-xl p-6 w-[500px] relative">
            <span class="close">&times;</span>
            <h2 class="text-[#0d141c] text-xl font-bold mb-4">Editar Clase</h2>
            <form id="editClassForm">
                <input type="hidden" id="edit_class_id" name="id">
                <div class="form-group">
                    <label for="edit_nombre">Nombre:</label>
                    <input type="text" id="edit_nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="edit_descripcion">Descripción:</label>
                    <textarea id="edit_descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_entrenador_id">Entrenador:</label>
                    <select id="edit_entrenador_id" name="entrenador_id" required>
                        <option value="">Seleccione un entrenador</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_dia_semana">Día de la semana:</label>
                    <select id="edit_dia_semana" name="dia_semana" required>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_hora_inicio">Hora de inicio:</label>
                    <input type="time" id="edit_hora_inicio" name="hora_inicio" required>
                </div>
                <div class="form-group">
                    <label for="edit_hora_fin">Hora de fin:</label>
                    <input type="time" id="edit_hora_fin" name="hora_fin" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="hideEditModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Funciones globales para el modal de edición
    function showEditModal(id) {
        const modal = document.getElementById('editClassModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Primero cargar los entrenadores
        loadTrainersForEdit().then(() => {
            // Luego cargar los datos de la clase
            fetch('index.php?controlador=clases&action=get_clase_data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error,
                        confirmButtonColor: '#0c77f2'
                    });
                    hideEditModal();
                    return;
                }
                
                document.getElementById('edit_class_id').value = data.id;
                document.getElementById('edit_nombre').value = data.nombre;
                document.getElementById('edit_descripcion').value = data.descripcion;
                document.getElementById('edit_entrenador_id').value = data.entrenador_id;
                document.getElementById('edit_dia_semana').value = data.dia_semana;
                document.getElementById('edit_hora_inicio').value = data.hora_inicio;
                document.getElementById('edit_hora_fin').value = data.hora_fin;
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar los datos de la clase',
                    confirmButtonColor: '#0c77f2'
                });
                hideEditModal();
            });
        });
    }

    function hideEditModal() {
        const modal = document.getElementById('editClassModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Función para cargar entrenadores en el select de edición
    async function loadTrainersForEdit() {
        try {
            const response = await fetch('index.php?controlador=clases&action=get_trainers');
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            const data = await response.json();
            
            const select = document.getElementById('edit_entrenador_id');
            select.innerHTML = '<option value="">Seleccione un entrenador</option>';
            
            if (Array.isArray(data)) {
                data.forEach(trainer => {
                    const option = document.createElement('option');
                    option.value = trainer.id;
                    option.textContent = trainer.nombre;
                    select.appendChild(option);
                });
            }
            return Promise.resolve();
        } catch (error) {
            console.error('Error al cargar entrenadores:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar la lista de entrenadores',
                confirmButtonColor: '#0c77f2'
            });
            return Promise.reject(error);
        }
    }

    // Funciones para el modal de nueva clase
    function showNewClassModal() {
        const modal = document.getElementById('newClassModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        loadTrainers(); // Cargar entrenadores al abrir el modal
    }

    function hideNewClassModal() {
        const modal = document.getElementById('newClassModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('newClassForm').reset();
    }

    // Función para cargar entrenadores en el select de nueva clase
    async function loadTrainers() {
        try {
            const response = await fetch('index.php?controlador=clases&action=get_trainers');
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            const data = await response.json();
            
            const select = document.getElementById('entrenador_id');
            select.innerHTML = '<option value="">Seleccionar entrenador</option>';
            
            if (Array.isArray(data)) {
                data.forEach(trainer => {
                    const option = document.createElement('option');
                    option.value = trainer.id;
                    option.textContent = trainer.nombre;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error al cargar entrenadores:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar la lista de entrenadores',
                confirmButtonColor: '#0c77f2'
            });
        }
    }

    $(document).ready(function() {
        // ... existing DataTable initialization code ...

        // Event listeners para el modal de nueva clase
        $('#newClassBtn').on('click', showNewClassModal);
        $('#closeModal').on('click', hideNewClassModal);
        $('#cancelNewClass').on('click', hideNewClassModal);

        // Cerrar modal de nueva clase al hacer clic fuera
        $('#newClassModal').on('click', function(e) {
            if (e.target === this) {
                hideNewClassModal();
            }
        });

        // Manejar el envío del formulario de nueva clase
        $('#newClassForm').on('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('index.php?controlador=clases&action=crear_clase', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: data.message,
                        confirmButtonColor: '#0c77f2'
                    });
                    hideNewClassModal();
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#0c77f2'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al crear la clase',
                    confirmButtonColor: '#0c77f2'
                });
            }
        });

        // Event listeners para el modal de edición
        $('#editClassModal .close').on('click', hideEditModal);
        
        // Cerrar modal de edición al hacer clic fuera
        $('#editClassModal').on('click', function(e) {
            if (e.target === this) {
                hideEditModal();
            }
        });

        // Manejar el envío del formulario de edición
        $('#editClassForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('index.php?controlador=clases&action=update_clase', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Clase actualizada exitosamente',
                        confirmButtonColor: '#0c77f2'
                    });
                    hideEditModal();
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Error al actualizar la clase',
                        confirmButtonColor: '#0c77f2'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar la clase',
                    confirmButtonColor: '#0c77f2'
                });
            });
        });
    });

    // Añadir la función de confirmación y borrado en el script
    function confirmarBorrado(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0c77f2',
            cancelButtonColor: '#49709c',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('index.php?controlador=clases&action=eliminar_clase', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: data.message,
                            confirmButtonColor: '#0c77f2'
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Error al eliminar la clase',
                            confirmButtonColor: '#0c77f2'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar la clase',
                        confirmButtonColor: '#0c77f2'
                    });
                });
            }
        });
    }

    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar-container');
      const overlay = document.querySelector('.overlay');
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
    }
    </script>


<!-- Chatbot Integration -->
<button
  class="fixed bottom-4 right-4 inline-flex items-center justify-center text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border rounded-full w-16 h-16 bg-black hover:bg-gray-700 m-0 cursor-pointer border-gray-200 bg-none p-0 normal-case leading-5 hover:text-gray-900"
  type="button" aria-haspopup="dialog" aria-expanded="false" data-state="closed" id="chatToggle">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white block border-gray-200 align-middle">
    <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" class="border-gray-200">
    </path>
  </svg>
</button>

<div style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05);"
  class="fixed bottom-[calc(4rem+1.5rem)] right-0 mr-4 bg-white p-6 rounded-lg border border-[#e5e7eb] w-[440px] h-[634px] flex flex-col hidden" id="chatContainer">

  <!-- Heading -->
  <div class="flex flex-col space-y-1.5 pb-6">
    <h2 class="font-semibold text-lg tracking-tight text-gray-900">Chatbot</h2>
    <p class="text-sm text-[#6b7280] leading-3">Powered by Gemini-2.0-flash</p>
  </div>

  <!-- Chat Container -->
  <div class="flex-1 overflow-y-auto pr-2">
    <!-- Chat Message AI -->
    <div class="flex gap-3 my-4 text-gray-600 text-sm">
      <span class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
        <div class="rounded-full bg-gray-100 border p-1">
          <svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"></path>
          </svg>
        </div>
      </span>
      <p class="leading-relaxed break-words flex-1"><span class="block font-bold text-gray-700">AI </span>¡Hola! Soy tu asistente virtual para el gimnasio. ¿En qué puedo ayudarte hoy?</p>
    </div>
  </div>
  <!-- Input box  -->
  <div class="flex items-center pt-4 mt-auto">
    <form class="flex items-center justify-center w-full space-x-2">
      <input
        class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-[#9ca3af] disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
        placeholder="Type your message" value="">
      <button
        class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-black hover:bg-[#111827E6] h-10 px-4 py-2">
        Send</button>
    </form>
  </div>
</div>

<script>
  const chatToggle = document.getElementById('chatToggle');
  const chatContainer = document.getElementById('chatContainer');
  const chatInput = document.querySelector('input[placeholder="Type your message"]');
  const sendChatBtn = document.querySelector('button:last-child');
  const chatMessagesContainer = document.querySelector('.flex-1.overflow-y-auto');
  let messages = [
      { role: "system", content: "You are a helpful assistant for a gym website." }
  ];

  // Función para alternar la visibilidad del chat
  chatToggle.addEventListener('click', () => {
      const isHidden = chatContainer.classList.contains('hidden');
      chatContainer.classList.toggle('hidden');
      chatToggle.setAttribute('aria-expanded', !isHidden);
      chatToggle.setAttribute('data-state', isHidden ? 'open' : 'closed');
  });

  // Verificar que los elementos existan
  if (!chatInput || !sendChatBtn || !chatMessagesContainer) {
      console.error('No se pudieron encontrar los elementos necesarios del chat');
  }

  const createChatMessage = (message, isUser = false) => {
      const messageDiv = document.createElement('div');
      messageDiv.className = 'flex gap-3 my-4 text-gray-600 text-sm';
      
      const iconSpan = document.createElement('span');
      iconSpan.className = 'relative flex shrink-0 overflow-hidden rounded-full w-8 h-8';
      
      const iconDiv = document.createElement('div');
      iconDiv.className = 'rounded-full bg-gray-100 border p-1';
      
      // Icono SVG según si es usuario o AI
      iconDiv.innerHTML = isUser ? 
          `<svg stroke="none" fill="black" stroke-width="0" viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
          </svg>` :
          `<svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"></path>
          </svg>`;
      
      iconSpan.appendChild(iconDiv);
      
      const messageP = document.createElement('p');
      messageP.className = 'leading-relaxed break-words flex-1';
      messageP.innerHTML = `<span class="block font-bold text-gray-700">${isUser ? 'You' : 'AI'}</span>${message}`;
      
      messageDiv.appendChild(iconSpan);
      messageDiv.appendChild(messageP);
      
      return messageDiv;
  };

  const generateResponse = (userMessage) => {
      if (!chatMessagesContainer) return;
      
      const thinkingMessage = createChatMessage('Thinking...', false);
      chatMessagesContainer.appendChild(thinkingMessage);
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

      fetch("controller/chatbot.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ messages: messages })
      })
      .then(res => {
          if (!res.ok) throw new Error("Network error");
          return res.json();
      })
      .then(data => {
          const reply = data.choices[0].message.content;
          thinkingMessage.remove();
          chatMessagesContainer.appendChild(createChatMessage(reply, false));
          chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
          messages.push({ role: "assistant", content: reply });
      })
      .catch(() => {
          thinkingMessage.remove();
          chatMessagesContainer.appendChild(createChatMessage("Oops! Something went wrong. Please try again!", false));
          chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
      });
  };

  const handleChat = () => {
      if (!chatInput || !chatMessagesContainer) return;
      
      const userMessage = chatInput.value.trim();
      if (!userMessage) return;

      messages.push({ role: "user", content: userMessage });
      chatMessagesContainer.appendChild(createChatMessage(userMessage, true));
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
      chatInput.value = "";
      generateResponse(userMessage);
  };

  if (sendChatBtn) {
      sendChatBtn.addEventListener("click", handleChat);
  }
  
  if (chatInput) {
      chatInput.addEventListener("keypress", function (e) {
          if (e.key === "Enter" && !e.shiftKey) {
              e.preventDefault();
              handleChat();
          }
      });
  }
</script>

  </body>
</html> 