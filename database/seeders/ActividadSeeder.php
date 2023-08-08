<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas =  [
            [
                'area_nombre' => 'Manejo de la Leche Cruda',
                'area_descripcion' => 'Capacitación en el manejo adecuado de la leche cruda para garantizar la calidad del producto final.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Procesamiento de Productos Lácteos',
                'area_descripcion' => 'Capacitación en cómo hacer varios productos lácteos como queso, yogur, mantequilla, etc.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Control de Calidad',
                'area_descripcion' => 'Aprender a realizar pruebas de calidad en los productos lácteos para garantizar que cumplen con los estándares.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Salud y Seguridad',
                'area_descripcion' => 'Esto podría incluir la capacitación en prácticas de higiene, manejo seguro de equipos, primeros auxilios, etc.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Mantenimiento de Equipos',
                'area_descripcion' => 'Los trabajadores pueden necesitar formación en el mantenimiento de los equipos utilizados en el procesamiento de los productos lácteos.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Gestión de Residuos',
                'area_descripcion' => 'La formación en cómo manejar correctamente los residuos de la producción láctea podría ser necesaria.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Normas y Regulaciones',
                'area_descripcion' => 'La formación en las regulaciones locales e internacionales podría ser necesaria, especialmente para aquellos que están exportando sus productos.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Gestión Empresarial y Marketing',
                'area_descripcion' => 'Esto podría incluir formación en gestión financiera, marketing, servicio al cliente, etc.',
                'area_estado' => true,
            ],
            [
                'area_nombre' => 'Tecnología y Automatización',
                'area_descripcion' => 'Con el crecimiento de la tecnología y la automatización en la industria de los productos lácteos, puede ser útil la formación en el uso de nuevas tecnologías y equipos.',
                'area_estado' => true,
            ],
        ];
        foreach ($areas as $value) {
            Area::create([
                'area_nombre' => $value['area_nombre'],
                'area_descripcion' => $value['area_descripcion'],
                'area_estado' => true,
            ]);
        }

        $tipos = [
            [
                'tipo_nombre' => 'Curso Básico',
                'tipo_descripcion' => 'Curso introductorio sobre los fundamentos del manejo y procesamiento de productos lácteos.',
                'tipo_estado' => true,
            ],
            [
                'tipo_nombre' => 'Curso Intermedio',
                'tipo_descripcion' => 'Curso de nivel intermedio que profundiza en técnicas y prácticas específicas en el manejo y procesamiento de productos lácteos.',
                'tipo_estado' => true,
            ],
            [
                'tipo_nombre' => 'Curso Avanzado',
                'tipo_descripcion' => 'Curso de nivel avanzado que cubre técnicas y prácticas especializadas en el manejo y procesamiento de productos lácteos.',
                'tipo_estado' => true,
            ],
            [
                'tipo_nombre' => 'Taller',
                'tipo_descripcion' => 'Taller práctico que permite a los participantes aplicar y practicar técnicas y habilidades específicas.',
                'tipo_estado' => true,
            ],
            [
                'tipo_nombre' => 'Webinar',
                'tipo_descripcion' => 'Seminario web o conferencia en línea que cubre un tema o conjunto de temas específicos.',
                'tipo_estado' => true,
            ],
        ];

        foreach ($tipos as $value) {
            Tipo::create([
                'tipo_nombre' => $value['tipo_nombre'],
                'tipo_descripcion' => $value['tipo_descripcion'],
                'tipo_estado' => true,
            ]);
        }
    }
}
