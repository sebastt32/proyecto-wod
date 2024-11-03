@extends('tenancy.layoutsSubDomain')
@section('title', 'Home page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="font-weight-bold">Gestor de Tareas para Subempresas</h2>
                </div>

                <div class="card-body">
                    <h4>Descripción del Proyecto</h4>
                    <p>
                        Bienvenido a nuestro sistema de gestión de tareas, diseñado específicamente para optimizar el manejo de proyectos dentro de subempresas. 
                        Este sistema se basa en un enfoque de multitenancy, lo que permite a cada subempresa operar de manera independiente, 
                        pero dentro de un marco centralizado que asegura una administración eficiente y coherente.
                    </p>

                    <h5>Características Principales</h5>
                    <ul>
                        <li><strong>Multitenancy:</strong> Cada subempresa tiene su propio espacio de trabajo, permitiendo personalización y autonomía.</li>
                        <li><strong>Gestión de Tareas:</strong> Crea, asigna y sigue el progreso de las tareas con facilidad.</li>
                        <li><strong>Informes en Tiempo Real:</strong> Accede a métricas y estadísticas para evaluar el rendimiento de cada subempresa.</li>
                        <li><strong>Interfaz Intuitiva:</strong> Navegación simple y accesible para todos los usuarios, sin importar su nivel técnico.</li>
                    </ul>

                    <h5>Beneficios</h5>
                    <p>
                        Este sistema no solo mejora la productividad, sino que también fomenta la colaboración entre equipos. 
                        Con un entorno seguro y segmentado, cada subempresa puede centrarse en sus objetivos, mientras que la empresa central mantiene un control general.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
