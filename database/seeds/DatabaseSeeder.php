<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cache roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // tables permissions
        Permission::create(['name' => 'Administrar Banners']);
        Permission::create(['name' => 'Administrar Roles']);
        Permission::create(['name' => 'Administrar Users']);

        // create roles and assign created permissions
        $role = Role::create(['name'=>'boss']);
        $role->givePermissionTo(Permission::all());
        $role = Role::create(['name'=>'administrador']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name'=>'investigador']);
        $role = Role::create(['name'=>'lider']);

        App\Persona::create([
            'dni' => '99999999',
            'nombres' => 'boss',
            'apellidos' => 'boss',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'boss',
            'password' => bcrypt('rickwd'),
            'status' => 1,
            'persona_id' => 1,
        ]);
        $new->assignRole('boss');

        App\Persona::create([
            'dni' => '99999990',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'vri1',
            'password' => bcrypt('vri1;*-'),
            'status' => 1,
            'persona_id' => 2,
        ]);
        $new->assignRole('administrador');
        App\Persona::create([
            'dni' => '99999991',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'vri2',
            'password' => bcrypt('vri2;*-'),
            'status' => 1,
            'persona_id' => 3,
        ]);
        $new->assignRole('administrador');
        App\Persona::create([
            'dni' => '99999992',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'vri3',
            'password' => bcrypt('vri3;*-'),
            'status' => 1,
            'persona_id' => 4,
        ]);
        $new->assignRole('administrador');
        App\Persona::create([
            'dni' => '99999993',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'vri4',
            'password' => bcrypt('vri4;*-'),
            'status' => 1,
            'persona_id' => 5,
        ]);
        $new->assignRole('administrador');
        App\Persona::create([
            'dni' => '99999994',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'username' => 'vri5',
            'password' => bcrypt('vri5;*-'),
            'status' => 1,
            'persona_id' => 6,
        ]);
        $new->assignRole('administrador');
        App\Persona::create([
            'id' => 492,
            'dni' => '99999995',
            'nombres' => 'vri',
            'apellidos' => 'vri',
            'genero' => 'Masculino',
            'email' => '',
            'telefono' => '',
            'celular' => '',
            'direccion' => '',
            'sitio_web' => '',
        ]);
        $new = App\User::create([
            'id' => 26,
            'username' => 'vri6',
            'password' => bcrypt('vri6;*-'),
            'status' => 1,
            'persona_id' => 492,
        ]);
        $new->assignRole('administrador');

        // Facultades
        // FAT
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Administración y Turismo',
            'slug' => Str::slug('Facultad de Administración y Turismo'),
            'abreviatura' => 'FAT',
            'main' => 0,
            'active' => 1,
        ]);
        // FC
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ciencias',
            'slug' => Str::slug('Facultad de Ciencias'),
            'abreviatura' => 'FC',
            'main' => 0,
            'active' => 1,
        ]);
        // FCA
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ciencias Agrarias',
            'slug' => Str::slug('Facultad de Ciencias Agrarias'),
            'abreviatura' => 'FCA',
            'main' => 0,
            'active' => 1,
        ]);
        // FCAM
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ciencias del Ambiente',
            'slug' => Str::slug('Facultad de Ciencias del Ambiente'),
            'abreviatura' => 'FCAM',
            'main' => 0,
            'active' => 1,
        ]);
        // FCM
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ciencias Médicas',
            'slug' => Str::slug('Facultad de Ciencias Médicas'),
            'abreviatura' => 'FCM',
            'main' => 0,
            'active' => 1,
        ]);
        // FCSEC
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ciencias Sociales, Educación y de la Comunicación',
            'slug' => Str::slug('Facultad de Ciencias Sociales, Educación y de la Comunicación'),
            'abreviatura' => 'FCSEC',
            'main' => 0,
            'active' => 1,
        ]);
        // FDCP
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Derecho y Ciencias Políticas',
            'slug' => Str::slug('Facultad de Derecho y Ciencias Políticas'),
            'abreviatura' => 'FDCCPP',
            'main' => 0,
            'active' => 1,
        ]);
        // FEC
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Economía y Contabilidad',
            'slug' => Str::slug('Facultad de Economía y Contabilidad'),
            'abreviatura' => 'FEC',
            'main' => 0,
            'active' => 1,
        ]);
        // FIC
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ingeniería Civil',
            'slug' => Str::slug('Facultad de Ingeniería Civil'),
            'abreviatura' => 'FIC',
            'main' => 0,
            'active' => 1,
        ]);
        // FIIA
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ingeniería de Industrias Alimentarias',
            'slug' => Str::slug('Facultad de Ingeniería de Industrias Alimentarias'),
            'abreviatura' => 'FIIA',
            'main' => 0,
            'active' => 1,
        ]);
        // FIMGM
        App\Facultad::create([
            'user_id' => 2,
            'nombre' => 'Facultad de Ingeniería de Minas, Geología y Metalurgia',
            'slug' => Str::slug('Facultad de Ingeniería de Minas, Geología y Metalurgia'),
            'abreviatura' => 'FIMGM',
            'main' => 0,
            'active' => 1,
        ]);
        // Departamentos académicos
        // FAT
        App\Departamento::create([
            'id' => 9,
            'user_id' => 2,
            'facultad_id' => 1,
            'nombre' => 'Departamento Académico de Administración',
            'slug' => Str::slug('Departamento Académico de Administración'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 10,
            'user_id' => 2,
            'facultad_id' => 1,
            'nombre' => 'Departamento Académico de Turismo',
            'slug' => Str::slug('Departamento Académico de Turismo'),
            'main' => 1,
            'active' => 1,
        ]);
        // FC
        App\Departamento::create([
            'id' => 23,
            'user_id' => 2,
            'facultad_id' => 2,
            'nombre' => 'Departamento Académico de Ciencias Básicas',
            'slug' => Str::slug('Departamento Académico de Ciencias Básicas'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 2,
            'user_id' => 2,
            'facultad_id' => 2,
            'nombre' => 'Departamento Académico de Matemática',
            'slug' => Str::slug('Departamento Académico de Matemática'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 3,
            'user_id' => 2,
            'facultad_id' => 2,
            'nombre' => 'Departamento Académico de Estadística',
            'slug' => Str::slug('Departamento Académico de Estadística'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 1,
            'user_id' => 2,
            'facultad_id' => 2,
            'nombre' => 'Departamento Académico de Ingeniería de Sistemas y Telecomunicaciones',
            'slug' => Str::slug('Departamento Académico de Ingeniería de Sistemas y Telecomunicaciones'),
            'main' => 1,
            'active' => 1,
        ]);
        // FCA
        App\Departamento::create([
            'id' => 11,
            'user_id' => 2,
            'facultad_id' => 3,
            'nombre' => 'Departamento Académico de Agronomía',
            'slug' => Str::slug('Departamento Académico de Agronomía'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 12,
            'user_id' => 2,
            'facultad_id' => 3,
            'nombre' => 'Departamento Académico de Ingeniería Agrícola',
            'slug' => Str::slug('Departamento Académico de Ingeniería Agrícola'),
            'main' => 1,
            'active' => 1,
        ]);
        // FCAM
        App\Departamento::create([
            'id' => 7,
            'user_id' => 2,
            'facultad_id' => 4,
            'nombre' => 'Departamento Académico de Ciencias del Ambiente',
            'slug' => Str::slug('Departamento Académico de Ciencias del Ambiente'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 8,
            'user_id' => 2,
            'facultad_id' => 4,
            'nombre' => 'Departamento Académico de Ingeniería Sanitaria',
            'slug' => Str::slug('Departamento Académico de Ingeniería Sanitaria'),
            'main' => 1,
            'active' => 1,
        ]);
        // FCM
        App\Departamento::create([
            'id' => 18,
            'user_id' => 2,
            'facultad_id' => 5,
            'nombre' => 'Departamento Académico de Enfermería',
            'slug' => Str::slug('Departamento Académico de Enfermería'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 19,
            'user_id' => 2,
            'facultad_id' => 5,
            'nombre' => 'Departamento Académico de Obstetricia',
            'slug' => Str::slug('Departamento Académico de Obstetricia'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 25,
            'user_id' => 2,
            'facultad_id' => 5,
            'nombre' => 'Departamento Académico de Propedéutica',
            'slug' => Str::slug('Departamento Académico de Propedéutica'),
            'main' => 1,
            'active' => 1,
        ]);
        // FCSEC
        App\Departamento::create([
            'id' => 17,
            'user_id' => 2,
            'facultad_id' => 6,
            'nombre' => 'Departamento Académico de Arqueología',
            'slug' => Str::slug('Departamento Académico de Arqueología'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 16,
            'user_id' => 2,
            'facultad_id' => 6,
            'nombre' => 'Departamento Académico de Ciencias de la Comunicación',
            'slug' => Str::slug('Departamento Académico de Ciencias de la Comunicación'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 24,
            'user_id' => 2,
            'facultad_id' => 6,
            'nombre' => 'Departamento Académico de Ciencias Sociales',
            'slug' => Str::slug('Departamento Académico de Ciencias Sociales'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 15,
            'user_id' => 2,
            'facultad_id' => 6,
            'nombre' => 'Departamento Académico de Educación',
            'slug' => Str::slug('Departamento Académico de Educación'),
            'main' => 1,
            'active' => 1,
        ]);
        // FDCP
        App\Departamento::create([
            'id' => 22,
            'user_id' => 2,
            'facultad_id' => 7,
            'nombre' => 'Departamento Académico de Derecho y Ciencias Políticas',
            'slug' => Str::slug('Departamento Académico de Derecho y Ciencias Políticas'),
            'main' => 1,
            'active' => 1,
        ]);
        // FEC
        App\Departamento::create([
            'id' => 14,
            'user_id' => 2,
            'facultad_id' => 8,
            'nombre' => 'Departamento Académico de Contabilidad',
            'slug' => Str::slug('Departamento Académico de Contabilidad'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 13,
            'user_id' => 2,
            'facultad_id' => 8,
            'nombre' => 'Departamento Académico de Economía',
            'slug' => Str::slug('Departamento Académico de Economía'),
            'main' => 1,
            'active' => 1,
        ]);
        // FIC
        App\Departamento::create([
            'id' => 21,
            'user_id' => 2,
            'facultad_id' => 9,
            'nombre' => 'Departamento Académico de Arquitectura',
            'slug' => Str::slug('Departamento Académico de Arquitectura'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 20,
            'user_id' => 2,
            'facultad_id' => 9,
            'nombre' => 'Departamento Académico de Ingeniería Civil',
            'slug' => Str::slug('Departamento Académico de Ingeniería Civil'),
            'main' => 1,
            'active' => 1,
        ]);
        // FIIA
        App\Departamento::create([
            'id' => 4,
            'user_id' => 2,
            'facultad_id' => 10,
            'nombre' => 'Departamento Académico de Ciencia y Tecnología de Alimentos',
            'slug' => Str::slug('Departamento Académico de Ciencia y Tecnología de Alimentos'),
            'main' => 1,
            'active' => 1,
        ]);
        App\Departamento::create([
            'id' => 5,
            'user_id' => 2,
            'facultad_id' => 10,
            'nombre' => 'Departamento Académico de Ingeniería Industrial',
            'slug' => Str::slug('Departamento Académico de Ingeniería Industrial'),
            'main' => 1,
            'active' => 1,
        ]);
        // FIMGM
        App\Departamento::create([
            'id' => 6,
            'user_id' => 2,
            'facultad_id' => 11,
            'nombre' => 'Departamento Académico de Ingeniería de Minas y Geología',
            'slug' => Str::slug('Departamento Académico de Ingeniería de Minas y Geología'),
            'main' => 1,
            'active' => 1,
        ]);
        //Escuelas Profesionales
        // //FAT
        // App\Escuela::create([
        //     'id' => 9,
        //     'user_id' => 2,
        //     'departamento_id' => 1,
        //     'nombre' => 'Escuela Profesional de Administración',
        //     'slug' => Str::slug('Escuela Profesional de Administración'),
        //     'main' => 0,
        //     'active' => 0,
        // ]);
        // App\Escuela::create([
        //     'id' => 10,
        //     'user_id' => 2,
        //     'departamento_id' => 2,
        //     'nombre' => 'Escuela Profesional de Turismo',
        //     'slug' => Str::slug('Escuela Profesional de Turismo'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FC
        // App\Escuela::create([
        //     'id' => 23,
        //     'user_id' => 2,
        //     'departamento_id' => 3,
        //     'nombre' => 'Escuela Profesional de Biotecnología',
        //     'slug' => Str::slug('Escuela Profesional de Biotecnología'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 3,
        //     'user_id' => 2,
        //     'departamento_id' => 5,
        //     'nombre' => 'Escuela Profesional de Estadística e Informática',
        //     'slug' => Str::slug('Escuela Profesional de Estadística e Informática'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 1,
        //     'user_id' => 2,
        //     'departamento_id' => 6,
        //     'nombre' => 'Escuela Profesional de Ingeniería de Sistemas e Informática',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería de Sistemas e Informática'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 24,
        //     'user_id' => 2,
        //     'departamento_id' => 6,
        //     'nombre' => 'Escuela Profesional de Ingeniería de Telecomunicaciones y Redes',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería de Telecomunicaciones y Redes'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 2,
        //     'user_id' => 2,
        //     'departamento_id' => 4,
        //     'nombre' => 'Escuela Profesional de Matemática',
        //     'slug' => Str::slug('Escuela Profesional de Matemática'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FCA
        // App\Escuela::create([
        //     'id' => 11,
        //     'user_id' => 2,
        //     'departamento_id' => 7,
        //     'nombre' => 'Escuela Profesional de Agronomía',
        //     'slug' => Str::slug('Escuela Profesional de Agronomía'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 12,
        //     'user_id' => 2,
        //     'departamento_id' => 8,
        //     'nombre' => 'Escuela Profesional de Ingeniería Agrícola',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería Agrícola'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FCAM
        // App\Escuela::create([
        //     'id' => 7,
        //     'user_id' => 2,
        //     'departamento_id' => 9,
        //     'nombre' => 'Escuela Profesional de Ingeniería Ambiental',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería Ambiental'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 8,
        //     'user_id' => 2,
        //     'departamento_id' => 10,
        //     'nombre' => 'Escuela Profesional de Ingeniería Sanitaria',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería Sanitaria'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FCM
        // App\Escuela::create([
        //     'id' => 18,
        //     'user_id' => 2,
        //     'departamento_id' => 11,
        //     'nombre' => 'Escuela Profesional de Enfermería',
        //     'slug' => Str::slug('Escuela Profesional de Enfermería'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 19,
        //     'user_id' => 2,
        //     'departamento_id' => 12,
        //     'nombre' => 'Escuela Profesional de Obstetricia',
        //     'slug' => Str::slug('Escuela Profesional de Obstetricia'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FCSEC
        // App\Escuela::create([
        //     'id' => 17,
        //     'user_id' => 2,
        //     'departamento_id' => 14,
        //     'nombre' => 'Escuela Profesional de Arqueología',
        //     'slug' => Str::slug('Escuela Profesional de Arqueología'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 16,
        //     'user_id' => 2,
        //     'departamento_id' => 15,
        //     'nombre' => 'Escuela Profesional de Ciencias de la Comunicación',
        //     'slug' => Str::slug('Escuela Profesional de Ciencias de la Comunicación'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 15,
        //     'user_id' => 2,
        //     'departamento_id' => 17,
        //     'nombre' => 'Escuela Profesional de Educación',
        //     'slug' => Str::slug('Escuela Profesional de Educación'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FDCP
        // App\Escuela::create([
        //     'id' => 22,
        //     'user_id' => 2,
        //     'departamento_id' => 18,
        //     'nombre' => 'Escuela Profesional de Derecho y Ciencias Políticas',
        //     'slug' => Str::slug('Escuela Profesional de Derecho y Ciencias Políticas'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FEC
        // App\Escuela::create([
        //     'id' => 14,
        //     'user_id' => 2,
        //     'departamento_id' => 19,
        //     'nombre' => 'Escuela Profesional de Contabilidad',
        //     'slug' => Str::slug('Escuela Profesional de Contabilidad'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 13,
        //     'user_id' => 2,
        //     'departamento_id' => 20,
        //     'nombre' => 'Escuela Profesional de Economía',
        //     'slug' => Str::slug('Escuela Profesional de Economía'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FIC
        // App\Escuela::create([
        //     'id' => 21,
        //     'user_id' => 2,
        //     'departamento_id' => 21,
        //     'nombre' => 'Escuela Profesional de Arquitectura y Urbanismo',
        //     'slug' => Str::slug('Escuela Profesional de Arquitectura y Urbanismo'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 20,
        //     'user_id' => 2,
        //     'departamento_id' => 22,
        //     'nombre' => 'Escuela Profesional de Ingeniería Civil',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería Civil'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FIIA
        // App\Escuela::create([
        //     'id' => 4,
        //     'user_id' => 2,
        //     'departamento_id' => 23,
        //     'nombre' => 'Escuela Profesional de Ingeniería de Industrias Alimentarias',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería de Industrias Alimentarias'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // App\Escuela::create([
        //     'id' => 5,
        //     'user_id' => 2,
        //     'departamento_id' => 24,
        //     'nombre' => 'Escuela Profesional de Ingeniería Industrial',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería Industrial'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        // // FIMGM
        // App\Escuela::create([
        //     'id' => 6,
        //     'user_id' => 2,
        //     'departamento_id' => 25,
        //     'nombre' => 'Escuela Profesional de Ingeniería de Minas',
        //     'slug' => Str::slug('Escuela Profesional de Ingeniería de Minas'),
        //     'main' => 0,
        //     'active' => 1,
        // ]);
        
        //Grupos de convenios especificos
        App\GrupoConvenioEspecifico::create([
            'user_id' => 2,
            'nombre' => 'Académicos',
            'slug' => Str::slug('Académicos'),
            'main' => 0,
            'active' => 1,
        ]);
        App\GrupoConvenioEspecifico::create([
            'user_id' => 2,
            'nombre' => 'Culturales',
            'slug' => Str::slug('Culturales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\GrupoConvenioEspecifico::create([
            'user_id' => 2,
            'nombre' => 'Financiera y Comercial',
            'slug' => Str::slug('Financiera y Comercial'),
            'main' => 0,
            'active' => 1,
        ]);
        App\GrupoConvenioEspecifico::create([
            'user_id' => 2,
            'nombre' => 'Proyectos',
            'slug' => Str::slug('Proyectos'),
            'main' => 0,
            'active' => 1,
        ]);
        App\GrupoConvenioEspecifico::create([
            'user_id' => 2,
            'nombre' => 'Salud',
            'slug' => Str::slug('Salud'),
            'main' => 0,
            'active' => 1,
        ]);
        //Tipos de convenios específicos
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Pasantías de docentes y estudiantes de pre y postgrado y personal administrativo',
            'slug' => Str::slug('Pasantías de docentes y estudiantes de pre y postgrado y personal administrativo'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Movilidad docente, estudiantes y administrativos',
            'slug' => Str::slug('Movilidad docente, estudiantes y administrativos'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Prácticas pre profesionales',
            'slug' => Str::slug('Prácticas pre profesionales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Capacitaciones diversas',
            'slug' => Str::slug('Capacitaciones diversas'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Complementación académica',
            'slug' => Str::slug('Complementación académica'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Proyección social',
            'slug' => Str::slug('Proyección social'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Desarrollo de tesis',
            'slug' => Str::slug('Desarrollo de tesis'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 1,
            'nombre' => 'Investigación científica',
            'slug' => Str::slug('Investigación científica'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 2,
            'nombre' => 'Proyección social para la difusión cultural',
            'slug' => Str::slug('Proyección social para la difusión cultural'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 2,
            'nombre' => 'Voluntariado docente, estudiantil y administrativo',
            'slug' => Str::slug('Voluntariado docente, estudiantil y administrativo'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 3,
            'nombre' => 'Préstamos personales',
            'slug' => Str::slug('Préstamos personales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 3,
            'nombre' => 'Cobro de tasas educacionales',
            'slug' => Str::slug('Cobro de tasas educacionales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 4,
            'nombre' => 'Administración y ejecución de proyectos locales, regionales, nacionales e internacionales',
            'slug' => Str::slug('Administración y ejecución de proyectos locales, regionales, nacionales e internacionales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 5,
            'nombre' => 'Campañas de atención médica',
            'slug' => Str::slug('Campañas de atención médica'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 5,
            'nombre' => 'Seguros de salud y de vida',
            'slug' => Str::slug('Seguros de salud y de vida'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvenioEspecifico::create([
            'user_id' => 2,
            'grupo_convenio_especifico_id' => 5,
            'nombre' => 'Capacitación y orientación para el bienestar social',
            'slug' => Str::slug('Capacitación y orientación para el bienestar social'),
            'main' => 0,
            'active' => 1,
        ]);

        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ciencias Médicas y de la Salud',
            'slug' => Str::slug('Ciencias Médicas y de la Salud'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ciencias Agrícolas',
            'slug' => Str::slug('Ciencias Agrícolas'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ingeniería y Tecnología',
            'slug' => Str::slug('Ingeniería y Tecnología'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ciencias Naturales',
            'slug' => Str::slug('Ciencias Naturales'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ingeniería y Tecnología - Ciencias Sociales - Humanidades',
            'slug' => Str::slug('Ingeniería y Tecnología - Ciencias Sociales - Humanidades'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Area::create([
            'user_id' => 2,
            'nombre' => 'Ciencias Naturales - Ciencias Agrícolas - Ciencias Sociales',
            'slug' => Str::slug('Ciencias Naturales - Ciencias Agrícolas - Ciencias Sociales'),
            'main' => 0,
            'active' => 1,
        ]);

        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 1,
            'nombre' => 'Salud pública y prevención de enfermedades endémicas',
            'slug' => Str::slug('Salud pública y prevención de enfermedades endémicas'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([4, 5, 6]);
        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 2,
            'nombre' => 'Sanidad agropecuaria y sistemas agrícolas sustentables',
            'slug' => Str::slug('Sanidad agropecuaria y sistemas agrícolas sustentables'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([2, 3, 4, 5, 6, 9]);
        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 3,
            'nombre' => 'Utilización de energías renovables',
            'slug' => Str::slug('Utilización de energías renovables'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([2, 3, 4, 9]);
        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 4,
            'nombre' => 'Preservación de la biodiversidad y de los ecosistemas regionales',
            'slug' => Str::slug('Preservación de la biodiversidad y de los ecosistemas regionales'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([2, 3, 4, 5, 6, 9]);
        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 5,
            'nombre' => 'Innovaciones tecnológicas, enocómicas, sociales, humanísticas, ambientales, de ciencias básicas y procesos productivos',
            'slug' => Str::slug('Innovaciones tecnológicas, enocómicas, sociales, humanísticas, ambientales, de ciencias básicas y procesos productivos'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([1, 2, 3, 6, 7, 8, 9, 10, 11]);
        $new = App\Linea::create([
            'user_id' => 2,
            'area_id' => 6,
            'nombre' => 'Seguridad alimentaria, riesgos ambientales y seguridad ciudadana',
            'slug' => Str::slug('Seguridad alimentaria, riesgos ambientales y seguridad ciudadana'),
            'main' => 0,
            'active' => 1,
        ]);
        $new->facultads()->attach([3, 4, 6, 10, 11]);

        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '1',
            'nombre' => 'Cuidados de enfermería en salud familiar y mental',
            'slug' => Str::slug('Cuidados de enfermería en salud familiar y mental'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '2',
            'nombre' => 'Cuidados de enfermería de las afecciones transmisibles y no transmisibles',
            'slug' => Str::slug('Cuidados de enfermería de las afecciones transmisibles y no transmisibles'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '3',
            'nombre' => 'Gestión y desempeño de enfermería',
            'slug' => Str::slug('Gestión y desempeño de enfermería'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '4',
            'nombre' => 'Estudio del binomio madre - niño en sus diversos aspectos',
            'slug' => Str::slug('Estudio del binomio madre - niño en sus diversos aspectos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '5',
            'nombre' => 'Salud sexual, reproductiva, y emergencias obstétricas',
            'slug' => Str::slug('Salud sexual, reproductiva, y emergencias obstétricas'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '6',
            'nombre' => 'Estudio de la medicina tradicional alternativa y complementaria, y de salud familiar y comunitaria',
            'slug' => Str::slug('Estudio de la medicina tradicional alternativa y complementaria, y de salud familiar y comunitaria'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 1,
            'numero' => '7',
            'nombre' => 'Salud pública, y sistemas de servicio de salud',
            'slug' => Str::slug('Salud pública, y sistemas de servicio de salud'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([4, 5, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 2,
            'numero' => '8',
            'nombre' => 'Recursos naturales, ecología, producción y extensión agropecuaria',
            'slug' => Str::slug('Recursos naturales, ecología, producción y extensión agropecuaria'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 2,
            'numero' => '9',
            'nombre' => 'Sanidad agraria, genética y fito-mejoramiento',
            'slug' => Str::slug('Sanidad agraria, genética y fito-mejoramiento'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 2,
            'numero' => '10',
            'nombre' => 'Evaluación de sustentabilidad de sistemas agrarios',
            'slug' => Str::slug('Evaluación de sustentabilidad de sistemas agrarios'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 2,
            'numero' => '11',
            'nombre' => 'Eficiencia energética, producción limpia y sostenibilidad de recursos',
            'slug' => Str::slug('Eficiencia energética, producción limpia y sostenibilidad de recursos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 3,
            'numero' => '12',
            'nombre' => 'Mecanización y energías renovables',
            'slug' => Str::slug('Mecanización y energías renovables'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '13',
            'nombre' => 'Recursos hídricos y mecánica de suelos',
            'slug' => Str::slug('Recursos hídricos y mecánica de suelos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '14',
            'nombre' => 'Cambio climático y gestión de riesgos',
            'slug' => Str::slug('Cambio climático y gestión de riesgos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '15',
            'nombre' => 'Educación, evaluación, control, monitoreo y remediación ambiental',
            'slug' => Str::slug('Educación, evaluación, control, monitoreo y remediación ambiental'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '16',
            'nombre' => 'Manejo, evaluación y restauración de los recursos naturales',
            'slug' => Str::slug('Manejo, evaluación y restauración de los recursos naturales'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '17',
            'nombre' => 'Sistemas de abastecimiento de agua potable y alcantarillado e instalaciones sanitarias en edificaciones',
            'slug' => Str::slug('Sistemas de abastecimiento de agua potable y alcantarillado e instalaciones sanitarias en edificaciones'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '18',
            'nombre' => 'Tratamiento y gestión de resíduos sólidos y gaseosos',
            'slug' => Str::slug('Tratamiento y gestión de resíduos sólidos y gaseosos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '19',
            'nombre' => 'Coservación y gestión sostenible de recursos naturales',
            'slug' => Str::slug('Coservación y gestión sostenible de recursos naturales'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 4,
            'numero' => '20',
            'nombre' => 'Valoración económica de patrimonio natural y los servicios ecosistémicos',
            'slug' => Str::slug('Valoración económica de patrimonio natural y los servicios ecosistémicos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 4, 5, 6, 9]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '21',
            'nombre' => 'Ordenamiento territorial y construcciones',
            'slug' => Str::slug('Ordenamiento territorial y construcciones'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '22',
            'nombre' => 'Innovación tecnológica minero metalúrgica',
            'slug' => Str::slug('Innovación tecnológica minero metalúrgica'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '23',
            'nombre' => 'Gestión, y explotación minera',
            'slug' => Str::slug('Gestión, y explotación minera'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '24',
            'nombre' => 'Gestión de la construcción sostenible',
            'slug' => Str::slug('Gestión de la construcción sostenible'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '25',
            'nombre' => 'Ingeniería estructural',
            'slug' => Str::slug('Ingeniería estructural'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '26',
            'nombre' => 'Ingeniería geotécnica y geomecánica, y riesgos geoambientales',
            'slug' => Str::slug('Ingeniería geotécnica y geomecánica, y riesgos geoambientales'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '27',
            'nombre' => 'Ingeniería de transportes',
            'slug' => Str::slug('Ingeniería de transportes'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '28',
            'nombre' => 'Diseño arquitectónico como factor e instrumento de desarrollo local, regional y nacional',
            'slug' => Str::slug('Diseño arquitectónico como factor e instrumento de desarrollo local, regional y nacional'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '29',
            'nombre' => 'Identidad, preservación y desarrollo del patromonio cultural-arquitectónico',
            'slug' => Str::slug('Identidad, preservación y desarrollo del patromonio cultural-arquitectónico'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '30',
            'nombre' => 'Estadística para la investigación científica',
            'slug' => Str::slug('Estadística para la investigación científica'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '31',
            'nombre' => 'Gestión de datos estadísticos',
            'slug' => Str::slug('Gestión de datos estadísticos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '32',
            'nombre' => 'Ciencias matemáticas y aplicaciones',
            'slug' => Str::slug('Ciencias matemáticas y aplicaciones'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '33',
            'nombre' => 'Sistemas y tecnologías de información, y gestión de la información',
            'slug' => Str::slug('Sistemas y tecnologías de información, y gestión de la información'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '34',
            'nombre' => 'Inteligencia artificial',
            'slug' => Str::slug('Inteligencia artificial'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '35',
            'nombre' => 'Redes de dispositivos electrónicos y sistemas digitales y control',
            'slug' => Str::slug('Redes de dispositivos electrónicos y sistemas digitales y control'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 3, 6, 9, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '36',
            'nombre' => 'Patrimonio arqueológico y cultural',
            'slug' => Str::slug('Patrimonio arqueológico y cultural'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '37',
            'nombre' => '---',
            'slug' => Str::slug('---'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '39',
            'nombre' => 'Gestión pedagógica, institucional y comunitaria',
            'slug' => Str::slug('Gestión pedagógica, institucional y comunitaria'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '40',
            'nombre' => 'Las NTICs y su aplicación educativa',
            'slug' => Str::slug('Las NTICs y su aplicación educativa'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '41',
            'nombre' => 'Cultura andina, interculturalidad, historia regional y nacional',
            'slug' => Str::slug('Cultura andina, interculturalidad, historia regional y nacional'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '42',
            'nombre' => 'Gestión de la calidad educativa',
            'slug' => Str::slug('Gestión de la calidad educativa'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '43',
            'nombre' => 'Lingüística aplicada y literatura',
            'slug' => Str::slug('Lingüística aplicada y literatura'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '44',
            'nombre' => 'Creatividad y medios',
            'slug' => Str::slug('Creatividad y medios'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '45',
            'nombre' => 'Comunicación organizacional',
            'slug' => Str::slug('Comunicación organizacional'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '46',
            'nombre' => 'Comunicación para el desarrollo social',
            'slug' => Str::slug('Comunicación para el desarrollo social'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([2, 6]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '47',
            'nombre' => 'Desarrollo e innovación empresarial',
            'slug' => Str::slug('Desarrollo e innovación empresarial'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([1, 10]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '48',
            'nombre' => 'Administración empresarial y gestión pública',
            'slug' => Str::slug('Administración empresarial y gestión pública'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([1, 10]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '49',
            'nombre' => 'Planificación y gestión de empresas turísticas, y del desarrollo turístico',
            'slug' => Str::slug('Planificación y gestión de empresas turísticas, y del desarrollo turístico'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([1, 10]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '50',
            'nombre' => 'Patrimonio natural y cultural',
            'slug' => Str::slug('Patrimonio natural y cultural'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([1, 10]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '51',
            'nombre' => 'Teoría y pensamiento económico',
            'slug' => Str::slug('Teoría y pensamiento económico'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([8]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '52',
            'nombre' => 'Ecnonomía pública',
            'slug' => Str::slug('Ecnonomía pública'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([8]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '53',
            'nombre' => 'Economía empresarial y de las organizaciones',
            'slug' => Str::slug('Economía empresarial y de las organizaciones'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([8]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '54',
            'nombre' => 'Contabilidad y auditoría',
            'slug' => Str::slug('Contabilidad y auditoría'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([8]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '55',
            'nombre' => 'Tributación, finanzas y preitaje',
            'slug' => Str::slug('Tributación, finanzas y preitaje'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([8]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '56',
            'nombre' => 'Modernización y reformas del estado peruano',
            'slug' => Str::slug('Modernización y reformas del estado peruano'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([6, 7]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '57',
            'nombre' => 'Construcción, democracia y derechos humanos',
            'slug' => Str::slug('Construcción, democracia y derechos humanos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([6, 7]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '58',
            'nombre' => 'Innovaciones en la administración de la justicia y de los procesos judiciales',
            'slug' => Str::slug('Innovaciones en la administración de la justicia y de los procesos judiciales'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([6, 7]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 5,
            'numero' => '59',
            'nombre' => 'Justicia e inseguridad ciudadana',
            'slug' => Str::slug('Justicia e inseguridad ciudadana'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([6, 7]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '60',
            'nombre' => 'Gestión de la biodiversidad y recursos genéticos',
            'slug' => Str::slug('Gestión de la biodiversidad y recursos genéticos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '61',
            'nombre' => 'Biotecnología y calidad de los alimentos',
            'slug' => Str::slug('Biotecnología y calidad de los alimentos'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '62',
            'nombre' => 'Procesos de producción tecnológico, comercialización y gestión',
            'slug' => Str::slug('Procesos de producción tecnológico, comercialización y gestión'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '63',
            'nombre' => 'Ingeniería de métodos, seguridad y salud ocupacional',
            'slug' => Str::slug('Ingeniería de métodos, seguridad y salud ocupacional'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '64',
            'nombre' => 'Ingeniería de procesos alimentarios',
            'slug' => Str::slug('Ingeniería de procesos alimentarios'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);
        App\Sublinea::create([
            'user_id' => 2,
            'linea_id' => 6,
            'numero' => '65',
            'nombre' => 'Conflicto sociales',
            'slug' => Str::slug('Conflicto sociales'),
            'main' => 0,
            'active' => 1,
        ])->facultads()->attach([3, 4, 6, 10, 11]);

        App\Descripcion::create([
            'descripcion' => '',
            'nosotros' => '',
            'mision' => 'Somos una comunidad científica que gestiona conocimiento a la ciencia, tecnología ,innovación y emprendimiento para mejorar la calidad de vida de la sociedad',
            'vision' => '“Institución académica con carreras profesionales acreditadas internacionalmente por su alta calidad en investigación científica e innovación tecnológica, comprometida con el emprendimiento, la competitividad del capital humano en los ámbitos públicos y privados, con responsabilidad social y desarrollo sostenible”.',
            'organigrama_path' => 'organigrama.jpg',
            'direccion' => 'Av. Centenario N°200 Huaraz - Ancash',
            'email_1' => 'investigacion@unasam.edu.pe',
            'email_2' => '',
            'email_3' => '',
            'telefono_1' => '043 421563',
            'telefono_2' => '',
            'telefono_3' => '',
            'anexo_1' => '',
            'anexo_2' => '',
            'anexo_3' => '',
            'celular_1' => '',
            'celular_2' => '',
            'celular_3' => '',
        ])->image()->create([
            'name' => 'imagen',
            'path' => 'default.jpg',
            'main' => 0,
        ]);

        App\Banner::create([
            'user_id' => 2,
            'link' => '',
            'main' => 1,
            'active' => 1,
        ])->image()->create([
            'name' => 'imagen',
            'path' => '1.jpg',
            'main' => 0,
        ]);
        App\Banner::create([
            'user_id' => 2,
            'link' => '',
            'main' => 0,
            'active' => 1,
        ])->image()->create([
            'name' => 'imagen',
            'path' => '2.jpg',
            'main' => 0,
        ]);

        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'RUTA DE INNOVACIÓN',
            'slug' => Str::slug('RUTA DE INNOVACIÓN'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '1.jpg',
            'main' => 0,
        ]);
        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'RUTA CONCYTEC 2019',
            'slug' => Str::slug('RUTA CONCYTEC 2019'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '2.jpg',
            'main' => 0,
        ]);
        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'III CARABANA CONCYTEC',
            'slug' => Str::slug('III CARABANA CONCYTEC'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '3.png',
            'main' => 0,
        ]);
        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'CONCURSO DE NACIMIENTO 2018',
            'slug' => Str::slug('CONCURSO DE NACIMIENTO 2018'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '4.jpg',
            'main' => 0,
        ]);
        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'PARTICIPACIÓN EN LA 41 ANIVERSARIO DE LA UNASAM',
            'slug' => Str::slug('PARTICIPACIÓN EN LA 41 ANIVERSARIO DE LA UNASAM'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '5.jpg',
            'main' => 0,
        ]);
        App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'JORNADA DE INVESTIGACIÓN 2018',
            'slug' => Str::slug('JORNADA DE INVESTIGACIÓN 2018'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '6.jpg',
            'main' => 0,
        ]);
        $new = App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'Capacitación y Acompañamiento a Docentes de la UNASAM: Estadística Aplicada a la Investigación',
            'slug' => Str::slug('Capacitación y Acompañamiento a Docentes de la UNASAM: Estadística Aplicada a la Investigación'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '7.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '8.jpg',
            'main' => 0,
        ]);
        $new = App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'La presentación de la revista de investigación científica “Aporte Santiaguino”',
            'slug' => Str::slug('La presentación de la revista de investigación científica “Aporte Santiaguino”'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '9.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '10.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '11.jpg',
            'main' => 0,
        ]);
        $new = App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'Taller de capacitación para investigadores en elaboración de proyectos y líneas de investigación',
            'slug' => Str::slug('Taller de capacitación para investigadores en elaboración de proyectos y líneas de investigación'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '12.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '13.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '14.jpg',
            'main' => 0,
        ]);
        $new = App\Galeria::create([
            'user_id' => 2,
            'titulo' => 'Curso Taller Internacional: Evaluación del impacto de la variable climática en la producción y manejo del cultivo de maíz',
            'slug' => Str::slug('Curso Taller Internacional: Evaluación del impacto de la variable climática en la producción y manejo del cultivo de maíz'),
            'descripcion' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '15.jpg',
            'main' => 0,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '16.jpg',
            'main' => 0,
        ]);

        App\TipoPublicacion::create([
            'user_id' => 2,
            'nombre' => 'Normas',
            'slug' => Str::slug('Normas'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoPublicacion::create([
            'user_id' => 2,
            'nombre' => 'Boletín',
            'slug' => Str::slug('Boletín'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoPublicacion::create([
            'user_id' => 2,
            'nombre' => 'Revistas',
            'slug' => Str::slug('Revistas'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoPublicacion::create([
            'user_id' => 2,
            'nombre' => 'Libros',
            'slug' => Str::slug('Libros de Docentes'),
            'main' => 0,
            'active' => 1,
        ]);

        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Tipificación, Calidad y Control de trabajos de publicación',
            'slug' => Str::slug('Reglamento de Tipificación, Calidad y Control de trabajos de publicación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N°181-2019-UNASAM, 05 de abril de 2019',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_1.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_1.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Convenios de Cooperación',
            'slug' => Str::slug('Reglamento de Convenios de Cooperación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 028 2018 - UNASAM, 30 de enero de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_2.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_2.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento del Registro de Trabajos de Investigación para optar grados académicos y títulos profesionales en la Universidad Nacional Santiago Antunez de Mayolo',
            'slug' => Str::slug('Reglamento del Registro de Trabajos de Investigación para optar grados académicos y títulos profesionales en la Universidad Nacional Santiago Antunez de Mayolo'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 131- 2018 - UNASAM, 30 de abril de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_3.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_3.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de uso Recursos Ordinarios con fines de investigación',
            'slug' => Str::slug('Reglamento de uso Recursos Ordinarios con fines de investigación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 036- 2018 - UNASAM, 14 de febrero de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_4.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_4.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de uso de Recursos de Canon , Sobrecanon y Regalias con fines de investigación',
            'slug' => Str::slug('Reglamento de uso de Recursos de Canon , Sobrecanon y Regalias con fines de investigación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 023- 2018 - UNASAM, 24 de enero de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_5.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_5.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Movilidad Docente, Estudiante y Administrativo',
            'slug' => Str::slug('Reglamento de Movilidad Docente, Estudiante y Administrativo'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 047 - 2018 - UNASAM, 16 de marzo de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_6.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_6.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Fondos de Investigación',
            'slug' => Str::slug('Reglamento de Fondos de Investigación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 046 - 2018 - UNASAM, 16 de marzo de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_7.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_7.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Incubadora de empresas',
            'slug' => Str::slug('Reglamento de Incubadora de empresas'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 029-2018-UNASAM, Huaraz 30 DE ENERO 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_8.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_8.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Formato de autorización para publicación de tesis y trabajos de investigación, para optar grados académicos y títulos profesionales',
            'slug' => Str::slug('Formato de autorización para publicación de tesis y trabajos de investigación, para optar grados académicos y títulos profesionales'),
            'descripcion' => 'Formato de autorización para publicación de tesis y trabajos de investigación, para optar Grados Académicos y Títulos Profesionales en el Repositorio Institucional Digital - UNASAM',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_9.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_9.docx',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Guía de monitoreo y supervisión para proyectos de investigación científica con Recursos de Canon, Sobrecanon Y Regalías',
            'slug' => Str::slug('Guía de monitoreo y supervisión para proyectos de investigación científica con Recursos de Canon, Sobrecanon Y Regalías'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario - Rector N°341- 2018- UNASAM , de fecha 30 de abril 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_10.jpg',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_10.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento General de Investigación',
            'slug' => Str::slug('Reglamento General de Investigación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario N° 083 - 2018 - UNASAM, 27 de abril de 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_11.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_11.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Guía de Informe Técnico - Financiero para Proyectos de Investigación Financiados con Recursos de Canon, Sobrecanon Y Regalías',
            'slug' => Str::slug('Guía de Informe Técnico - Financiero para Proyectos de Investigación Financiados con Recursos de Canon, Sobrecanon Y Regalías'),
            'descripcion' => 'Aprobado con Resolución Vicerrectoral de Investigación N° 003 - 2018 - UNASAM, del 02 de abril de 2018.',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_12.jpg',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_12.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Líneas de Investigación y Sublíneas de Investigación de la UNASAM',
            'slug' => Str::slug('Líneas de Investigación y Sublíneas de Investigación de la UNASAM'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario - Rector N°443 - 2018- UNASAM , de fecha 10 de setiembre 2018',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_13.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_13.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Normas para la publicación de artículos científicos en Aporte Santiaguino',
            'slug' => Str::slug('Normas para la publicación de artículos científicos en Aporte Santiaguino'),
            'descripcion' => 'Normas para la Publicación de Artículos Científicos',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_14.jpg',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_14.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Docente Investigador',
            'slug' => Str::slug('Reglamento de Docente Investigador'),
            'descripcion' => 'Resolución de Consejo Universitario - Rector, Nº 477-2017-UNASAM (06 de septiembre 2017)',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_15.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_15.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Reglamento de Derechos de Autor y Patentes',
            'slug' => Str::slug('Reglamento de Derechos de Autor y Patentes'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario - Rector N°216 - 2017- UNASAM , de fecha 06 de abril 2017',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_16.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_16.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Código de Ética de Investigación',
            'slug' => Str::slug('Código de Ética de Investigación'),
            'descripcion' => 'Aprobado con Resolución de Consejo Universitario - Rector N°217- 2017- UNASAM , de fecha 06 de abril 2017',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_17.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_17.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 1,
            'titulo' => 'Plan Estratégico Institucional 2017-2021',
            'slug' => Str::slug('Plan Estratégico Institucional 2017-2021'),
            'descripcion' => 'Contenido del plan Estratégico de Investigación',
            'main' => 0,
            'active' => 1,
        ]);
        $new->image()->create([
            'name' => 'imagen',
            'path' => 'norma_18.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'norma_18.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 2,
            'titulo' => 'LAS PATENTES Y SU IMPORTANCIA EN LA INVESTIGACIÓN CIENTÍFICA',
            'slug' => Str::slug('LAS PATENTES Y SU IMPORTANCIA EN LA INVESTIGACIÓN CIENTÍFICA'),
            'descripcion' => 'Documento que permite entender la utilidad práctica de la información tecnológica, comercial y legal que se puede obtener de los documentos de patentes que son de libre de acceso, así como aprender estrategias de búsqueda de patentes en las respectivas bases de datos',
            'main' => 0,
            'active' => 1,
        ]);
       $new->image()->create([
            'name' => 'imagen',
            'path' => 'boletin_1.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'boletin_1.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 2,
            'titulo' => 'GUÍA DE PATENTES PARA INVESTIGADORES',
            'slug' => Str::slug('GUÍA DE PATENTES PARA INVESTIGADORES'),
            'descripcion' => 'Documento que introduce y centra al lector en los conceptos básicos del sistema de propiedad intelectual en general, y en lo particular en las características, alcances, particularidades, trámite y otros temas de interés de las patentes, como instrumentos de protección de las invenciones',
            'main' => 0,
            'active' => 1,
        ]);
       $new->image()->create([
            'name' => 'imagen',
            'path' => 'boletin_2.png',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'boletin_2.pdf',
        ]);
        $new = App\Publicacion::create([
            'user_id' => 2,
            'tipo_publicacion_id' => 2,
            'titulo' => 'Boletín Informativo',
            'slug' => Str::slug('Boletín Informativo'),
            'descripcion' => 'La Dirección General de Investigación cuenta con un boletín informativo de publicación semestral. En este documento se da a conocer de todas las actividades relacionadas a la gestión de la Investigación y difusión de la investigación de la comunidad santiaguina. Entre los ejes principales destacan convocatorias y seguimiento de las investigaciones financiadas con recursos ordinarios, recursos de canon, sobre canon y regalías. Así mismo, los convenios marco y especifico con instituciones académicas públicas y privadas. También difunde las convocatorias de investigación, ponencias para eventos académicos y artículos para revistas, científicas además las acciones referida al repositorio institucional y las pasantías y movilidad estudiantil de la Red Peruana de Universidades (RPU), entre otros.',
            'main' => 0,
            'active' => 1,
        ]);
       $new->image()->create([
            'name' => 'imagen',
            'path' => 'boletin_3.jpg',
            'main' => 0,
        ]);
        $new->file()->create([
            'name' => 'documento',
            'path' => 'boletin_3.pdf',
        ]);

        App\Etiqueta::create([
            'user_id' => 2,
            'nombre' => 'Convocatorias de investigación',
            'slug' => 'convocatorias-de-investigacion',
            'main' => 0,
            'active' => 1,
        ]);
        App\Etiqueta::create([
            'user_id' => 2,
            'nombre' => 'Convocatorias de artículos',
            'slug' => 'convocatorias-de-articulos',
            'main' => 0,
            'active' => 1,
        ]);
        App\Etiqueta::create([
            'user_id' => 2,
            'nombre' => 'Convocatorias de eventos académicos',
            'slug' => 'convocatorias-de-eventos-academicos',
            'main' => 0,
            'active' => 1,
        ]);
        App\Etiqueta::create([
            'user_id' => 2,
            'nombre' => 'Convocatorias de emprendimiento',
            'slug' => 'convocatorias-de-emprendimiento',
            'main' => 0,
            'active' => 1,
        ]);

        $new = App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'COMITÉ ASESOR SciELO Perú',
            'slug' => Str::slug('COMITÉ ASESOR SciELO Perú'),
            'descripcion' => 'http://www.scielo.org.pe/',
            'fecha' => '2019-05-16',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '1.png',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Minedu asigna más de S/. 19 millones para docentes investigadores',
            'slug' => Str::slug('Minedu asigna más de S/. 19 millones para docentes investigadores'),
            'descripcion' => 'El Ministerio de Educación (Minedu) destinará este año más de 19 millones de soles para continuar con el financiamiento del bono al docente investigador, que equivale al 50% de los haberes totales que perciben estos catedráticos de universidades públicas, informó dicho portafolio. Precisó que esta medida, que se enmarca a los dispuesto en el artículo 86 de la Ley Universitaria, beneficiará a 722 catedráticos de 42 universidades públicas de diferentes regiones del Perú. Con este fin, el Decreto Supremo N° 138-2019-EF, publicado en el diario oficial El Peruano, establece el monto mensual de la bonificación especial para el docente investigador, las condiciones para su percepción y sus características Para acceder a esta bonificación, los docentes investigadores deben estar registrados en el Aplicativo Informático para el Registro Centralizado de Planillas y de Datos de los Recursos Humanos del Sector Público, ser catalogados como investigadores Regina por el Concytec y cumplir con la normativa interna de cada universidad. Además, la universidad pública a la que pertenece el docente investigador debe estar adecuada a la Ley Universitaria. El Minedu recordó que esta bonificación se otorga desde 2017 a docentes investigadores de universidades públicas.',
            'fecha' => '2019-05-03',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '2.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Se revela la primera imagen de un agujero negro en la historia',
            'slug' => Str::slug('Se revela la primera imagen de un agujero negro en la historia'),
            'descripcion' => 'Fue en 1921 cuando Albert Einstein predijo, en su teoría de la relatividad general, la existencia de lugares en los que el tejido del espacio-tiempo se distorsiona de tal manera que nada, ni siquiera la luz, puede escapar de ellos. El concepto de agujero negro se sumaba a estas definiciones. Sin embargo, demostrar su existencia no había sido posible hasta el día de hoy, ya que resulta difícil ver las sombras de los agujeros negros con claridad porque las imágenes son borrosas por el gas interestelar. Científicos acaban de lograr obtener la primera imagen de un agujero negro usando el telescopio Event Horizon en el centro de la galaxia M87, situado a unos 50 millones de años luz de la Tierra y con 6 mil millones más masa que nuestro sol, uno de los más fascinantes jamás descubiertos. Se logra apreciar un anillo brillante formado a medida que la luz se curva en la intensa gravedad alrededor del agujero negro. Emite un rayo que se extiende durante unos 5.000 años luz hacia ambos lados. Esta foto se produjo gracias a un algoritmo que combina información de ocho radiotelescopios de todo el mundo, y más de 200 de científicos, bajo la supervición del consorcio internacional de científicos "Event Horizon Telescope" (Telescopio del Horizonte de Sucesos). "Las ondas de radio vienen con muchas ventajas", dice Katie Bouman, estudiante del MIT en ingeniería eléctrica y ciencias de la computación, quien lideró el desarrollo del algoritmo. "Así como las frecuencias de radio pasan a través de paredes, ellas también perforan el polvo de las galaxias. Nunca hubiéramos podido ver el centro de nuestra galaxia con ondas invisibles porque hay mucho en medio". Pero necesitarían de una gran antena para lograrlo. "Un agujero negro es muy muy lejano y compacto" dice Bouman, "[Tomar una foto de un agujero negro en el centro de la Vía Láctea es] equivalente a tomar una imagen de una uva en la luna, pero con un telescopio de radio. Para capturar la imagen de algo así de pequeño significaría usar un telescopio de 10,000 kilómetros de diámetro, lo que no es práctico porque el diametro de la tierra ni siquiera alcanza los 13,000 kilómetros". Utilizando la interferometría de línea de base muy larga, según el Observatorio Europeo del Sur, que forma parte de la EHT. Esto crea un telescopio virtual del mismo tamaño que la Tierra, solucionando el problema.',
            'fecha' => '2019-04-10',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '3.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec coorganiza el Biophysical Society Thematic Meeting: conoce cómo postular a una beca de inscripción.',
            'slug' => Str::slug('Concytec coorganiza el Biophysical Society Thematic Meeting: conoce cómo postular a una beca de inscripción.'),
            'descripcion' => 'La Sociedad de Biofísica de Estados Unidos (BPS) e investigadores de Argentina, Chile, Estados Unidos y Perú realizan el evento Revisiting the Central Dogma of Molecular Biology at the Single-Molecule Level, coorganizado por el Concytec, a efectuarse del 19 al 21 de julio de 2019 en Lima. El objetivo del evento es mostrar los descubrimientos más recientes obtenidos en el uso de moléculas individuales como herramientas para la replicación del ADN, transcripción, traducción, degradación de proteínas, motores moleculares y otros procesos que se dan a nivel celular. El encuentro está dirigido especialmente a estudiantes, profesionales e investigadores interesados en microscopía, bioingeniería, biología molecular, bioquímica y química. La actividad incluirá conferencias, sesiones de discusión y presentaciones de posters. Los temas específicos incluyen: biofísica de la transcripción, síntesis de proteínas, plegamiento, clasificación y degradación, plegamiento de proteínas mediado por chaperonas, interacciones ADN-proteína, motores moleculares, así como instrumentación, dinámica molecular dirigida y aplicaciones de una sola molécula para comprender la biología de los patógenos y enfermedades infecciosas. El Concytec proporcionará nueve (9) becas para cubrir los costos de inscripción a este importante evento. Estas becas cubrirán el registro de tres (3) investigadores y seis (6) estudiantes (pregrado y/o posgrado). Se dará preferencia a estudiantes e investigadores que provengan de regiones que presenten sus trabajos bajo la modalidad de ponencias orales o presentación de posters. Para participar, los interesados deberán revisar la página web del evento y completar el formulario de expresión de interés. El formulario debe ser enviado al correo electrónico rsotomayor@concytec.gob.pe (dirigido a Raquel Sotomayor) hasta el 22 de abril a las 17:15 horas. Es necesario consignar la hoja de vida (máximo dos páginas) o adjuntar el link del CV desde el CTI Vitae – Ex-DINA. Es importante precisar que el evento se desarrollará en idioma inglés (sin traducción), y el número de participantes es limitado. El Concytec informará a los seleccionados para las becas a través del correo electrónico de contacto brindado en su postulación.',
            'fecha' => '2019-03-27',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '4.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Vigilancia Tecnológica e Inteligencia Estratégica: herramientas claves para innovar',
            'slug' => Str::slug('Vigilancia Tecnológica e Inteligencia Estratégica: herramientas claves para innovar'),
            'descripcion' => 'Sostiene experta internacional, Nancy Pérez, durante charla organizada por Concytec Se realizarán tres actividades enfocadas en estos avances Primer taller fue dirigido a institutos públicos de investigación y universidades públicas y privadas de Lima, Piura, Arequipa, Cusco, Áncash, Huánuco, Amazonas, Tacna y Callao La Vigilancia Tecnológica e Inteligencia Estratégica (VT/IE) son herramientas claves para los procesos de innovación y pueden aplicarse en el ámbito académico, empresarial y gubernamental con una metodología acorde a cada necesidad, aseguró la coordinadora de estudios tecnológicos, vigilancia e inteligencia estratégica de Argentina, Nancy Pérez. Sostuvo que dichos instrumentos de investigación “permiten mejorar la calidad de la información para que las personas que toman las decisiones lo hagan de forma coherente y generen un impacto positivo en el país, el cual permita avanzar en lo económico, social y tecnológico”. Tras recordar que la Vigilancia Tecnológica e Inteligencia Estratégica aparecieron en el mundo hace 25 años, Pérez consideró que, especialmente, en las organizaciones de Latinoamérica se debería generar un área donde se empiecen a trabajar esos temas “siendo las universidades un foco importante para el estudio”. En ese sentido, indicó que la Vigilancia Tecnológica implica la búsqueda de información y la Inteligencia Estratégica está vinculada al análisis cualitativo y cuantitativo por lo que sería incoherente separarlas, ya que ambas se complementan e influyen en la prospectiva y en el planeamiento estratégico. La experta internacional estuvo a cargo de la charla “Vigilancia Tecnológica e Inteligencia Estratégica”, organizada por el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) con el apoyo de la Secretaría de Ciencia, Tecnología e Innovación Productiva de Argentina, en el marco de convenio suscrito entre ambas instituciones. Dicho acuerdo tiene como objetivo entrenar a profesionales en temas de Vigilancia Tecnológica e Inteligencia Estratégica para la toma de decisiones, por lo que este primer taller estuvo dirigido a institutos públicos de investigación y universidades de nueve regiones: Lima, Piura, Arequipa, Cusco, Áncash, Huánuco, Amazonas, Tacna y Callao. Por su parte, Ana Sobarzo, subdirectora de Innovación y Transferencia Tecnológica del Concytec, dijo que en el Perú recién se está abordando la Vigilancia Tecnológica e Inteligencia Estratégica y “si logramos que todos los actores trabajen en conjunto podremos tener un país más competitivo haciendo desarrollo sostenible”. Indicó que desde el Concytec se busca promover investigación vinculada a la demanda de los sectores productivos y a las necesidades de las localidades donde esta se desarrolla porque “no podemos tener universidades en regiones que no generen nuevos productos o procesos para las comunidades agrícolas o no tengan en cuenta las condiciones climáticas extremas que ahora vivimos producto del cambio climático”. Sobarzo dijo que el Concytec realizará tres talleres de Vigilancia Tecnológica.',
            'fecha' => '2019-04-10',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '5.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'El ICGEB abre convocatorias para pasantías y becas de doctorado y posdoctorado Oportunidades de trabajo y estudio en laboratorios en Italia, la India y Sudáfrica',
            'slug' => Str::slug('El ICGEB abre convocatorias para pasantías y becas de doctorado y posdoctorado Oportunidades de trabajo y estudio en laboratorios en Italia, la India y Sudáfrica'),
            'descripcion' => 'El International Centre for Genetic Engineering and Biotechnology (Centro Internacional para la Ingeniería Genética y Biotecnología) es una organización intergubernamental científica internacional de alto nivel, cuenta con 46 laboratorios de última generación en Trieste, Italia, Nueva Delhi, India y Ciudad del Cabo, Sudáfrica, y forma una red interactiva con más de 60 estados miembro. Desempeña un papel clave en la biotecnología en todo el mundo por su excelencia en investigación, capacitación y transferencia de tecnología a la industria, para contribuir en términos concretos al logro del desarrollo global sostenible. Así, el ICGEB (por sus siglas en inglés) fue creado en 1983 y hoy varias convocatorias en su seno llevan el nombre de su fundador, Arturo Falaschi. El ICGEB está orientado a la investigación avanzada y la capacitación en biología molecular y biotecnología y el avance del conocimiento, aplicando las últimas técnicas en los campos de: biomedicina, mejora de cultivos, protección / remediación ambiental, producción de biofármacos, bioplaguicidas y biocombustibles. El Concytec, al gestionar el pago de la membresía anual del Centro Internacional de Ingeniería Genética y Biotecnología (ICGEB) ratifica al Perú como miembro de esta institución científica internacional, lo que permite que investigadores peruanos puedan aplicar a los fondos que brinda el ICGEB para sus países miembros. Becas Arturo Falaschi Programa de investigación colaborativa (CRP por sus siglas en inglés), fondo destinado a financiar proyectos de hasta 3 años que aborden problemas científicos originales de relevancia para el país del postulante, así como de interés regional. Cierre: 30 de abril Requisitos: Aquí Para pasantías de investigación predoctoral (1 a 12 meses) y posdoctoral (1 a 6 meses) en sedes del ICGEB o de otros países miembros del ICGEB (becas SMART, de 3 a 9 meses). Cierre: 30 de setiembre Requisitos: Se requiere la aceptación del laboratorio de acogida y un plan de investigación. Otros requisitos: Modalidad predoctoral Modalidad posdoctoral Para financiamiento completo del ICGEB para doctorado y posdoctorado en Trieste, Nueva Delhi y Ciudad del Cabo. Cierre: 30 de setiembre Requisitos: Se requiere contactar a investigadores en el centro donde se harán los estudios y formular un proyecto. Otros requisitos: Modalidad PhD Modalidad posdoctoral Consultas adicionales, dirigidas a la representante en el Perú del ICBEG, Dra. Cristina Guerra al e-mail: cristina.guerra@upch.pe Actualmente, tres jóvenes peruanos vienen cursando doctorados en Trieste gracias a estas becas. Entérate de las demás convocatorias del ICGEB en el año aquí.',
            'fecha' => '2019-04-15',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '6.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Lanzamiento del Portal de Investigación, Innovación e Intercambios Estudiantiles',
            'slug' => Str::slug('Lanzamiento del Portal de Investigación, Innovación e Intercambios Estudiantiles'),
            'descripcion' => 'Se pone en conocimiento el lanzamiento del Portal de Investigación,Innovación e Intercambio estudiantil "Acuerdos Universitarios con Francia", el mismo que contiene la cartografía de los convenios disponibles (https://acuerdosuniversitariosconfrancia.pe/.) Esta iniciativa de la Embajada de Francia en el Perú,con el apoyo del Instituto Nacional de Investigación en Informática y Automática (INRIA), cuenta con el Auspicio del Ministerio de Europa y de asuntos exteriores (MEAE).',
            'fecha' => '2019-04-15',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '7.png',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Cierre de brecha de investigadores es vital para Política Nacional de Competitividad y Productividad',
            'slug' => Str::slug('Cierre de brecha de investigadores es vital para Política Nacional de Competitividad y Productividad'),
            'descripcion' => 'Sostuvo presidenta del Concytec, Fabiola León-Velarde Durante Taller de Gobernanza y Gestión de la Ciencia, Tecnología e Innovación en el Desarrollo Regional, donde participarán representantes del sector público, privado, gobiernos regionales y cámaras de comercio regionales La presidenta del Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec), Fabiola León-Velarde, consideró que si no somos conscientes de que primero debemos generar recurso humano en ciencia, tecnología e innovación, que permita transferir el conocimiento, no será posible cumplir el objetivo establecido en el Plan Nacional de Competitividad y Productividad (PNCP). “Es vital cerrar la brecha de investigadores que existe en nuestro país”, enfatizó León-Velarde, durante la inauguración del Taller de Gobernanza y Gestión de la Ciencia, Tecnología e Innovación en el Desarrollo Regional, que organiza el Concytec junto a la Embajada de Reino Unido y el British Council, con el apoyo del Fondo Newton - Paulet. Tras expresar la necesidad de promover y fortalecer a las universidades e institutos de investigación, mostró su preocupación por la falta de un marco normativo en el Perú que establezca la denominación de investigador “porque hay docentes que investigan o investigadores que trabajan en institutos de investigación con cargo administrativo, pero con mucha pena digo que no existe el investigador en el Perú y si eso no lo resolvemos, no podemos cerrar la brecha”. Por su parte, la embajadora de Reino Unido en Perú, Kate Harrison, señaló que la colaboración entre ambos países en investigación e innovación se ha fortalecido mucho en estos últimos años. “Gracias al Fondo Newton-Paulet, este año están iniciando seis grandes proyectos  investigación sobre el impacto del derretimiento de los glaciales tropicales y cinco proyectos sobre la relación entre nutrición y salud. Esto no hubiera sido posible sin el liderazgo y la colaboración del Concytec”, subrayó. “La ciencia y la innovación son importantes e imprescindibles para el desarrollo sostenible de cualquier país. No hay crecimiento que dure sin nuevos conocimientos, tecnologías y prácticas. Aún más importante, la ciencia e innovación impactan y mejoran nuestras vidas con, por ejemplo, energías limpias y mejores medicamentos. Por ello, el Reino Unido ha diseñado una Estrategia Industrial que guía al Gobierno británico y otros actores, como las empresas e investigadores, para incrementar nuestra productividad y transformar nuestra economía para los desafíos del futuro” subrayó la diplomática. León-Velarde, destacó el trabajo continuo de su representada con el Gobierno británico y dijo que “es necesario consolidar, priorizar y focalizar los objetivos que nos permitan generar capacidades e información, así como los diferentes fondos que destina el Perú para investigación y trabajar de forma articulada en un plan de descentralización para un mayor acercamiento con las regiones”. Cabe destacar que Reino Unido acompaña al Concytec en su objetivo de incentivar la inclusión de la ciencia como parte de nuestra vida diaria y promueve becas para pasantías en innovación y emprendimiento, a través del Fondo Newton-Paulet. El Taller de Gobernanza y Gestión de la Ciencia, Tecnología e Innovación en el Desarrollo Regional forma parte del Fondo Newton-Paulet para construir capacidades en el Sistema Peruano de Ciencia, Tecnología e Innovación, a través de su programa de Desarrollo y Compromiso. Es organizado por el British Council y el Concytec, con apoyo de Oxentia, líder en implementación de políticas de innovación en el Reino Unido, y participan representantes del sector público, privado, gobiernos regionales y cámaras de comercio regionales.',
            'fecha' => '2019-02-18',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '8.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec reanuda ciclo de charlas sobre beneficios tributarios para empresas que invierten en innovación',
            'slug' => Str::slug('Concytec reanuda ciclo de charlas sobre beneficios tributarios para empresas que invierten en innovación'),
            'descripcion' => 'Inicia 28 de febrero en el auditorio de la Sociedad Nacional de Industrias Ley permite deducir hasta el 175% del Impuesto a la Renta sobre los gastos incurridos Con la finalidad de incentivar la inversión privada en proyectos de Investigación Científica, Desarrollo Tecnológico o Innovación Tecnológica (I+D+i), el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) reanuda su ciclo de charlas informativas para que más empresas conozcan y accedan a los alcances de la Ley Nº 30309, referida a beneficios tributarios. Las charlas previstas para el 2019 se realizarán una vez al mes, desde el 28 de febrero hasta el 29 de noviembre, en el auditorio Nº 2 de la Sociedad Nacional de Industrias (SNI), ubicada en la calle Los Laureles Nº 365, en San Isidro. Las sesiones serán de 08:00 a.m. a 10:00 a.m. El ingreso es gratuito, previa inscripción, enviando sus datos (nombre de la empresa, nombre completo de los participantes, incluido cargo y dirección de contacto) al correo incentivos@concytec.gob.pe. También pueden inscribirse minutos antes de iniciar el evento en el mismo auditorio. En las sesiones, los especialistas del Concytec brindarán detalles y precisiones a los participantes sobre los requisitos, procedimientos y modalidades que se aplican para la aprobación de proyectos de Investigación Científica, Desarrollo Tecnológico o Innovación Tecnológica que puedan acceder a beneficios tributarios. Cabe indicar desde el 2016 está vigente la Ley Nº 30309, la cual concede hasta un 175% de deducción del Impuesto a la Renta para las empresas que inviertan en I+D+i, a través de proyectos desarrollados en el Perú o 150% cuando son realizados en centros de investigación científica, desarrollo tecnológico o innovación tecnológica domiciliados fuera del país.',
            'fecha' => '2019-02-19',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '9.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => '(Comunicado Nº 001-CONCYTEC-2019) Denominación e identidad gráfica de CTI Vitae (antes DINA)',
            'slug' => Str::slug('(Comunicado Nº 001-CONCYTEC-2019) Denominación e identidad gráfica de CTI Vitae (antes DINA)'),
            'descripcion' => 'El Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) informa que, mediante la Resolución de Presidencia Nº 015 -2019-CONCYTEC-P, se oficializó la denominación e identidad gráfica de “CTI Vitae - Hojas de Vida afines a la Ciencia y Tecnología” para reemplazar al nombre del “Directorio Nacional de Investigadores e Innovadores (DINA)”. Dicho cambio, tal como señala la mencionada resolución, obedece al sustento técnico de la Dirección de Evaluación y Gestión del Conocimiento del Concytec, debido a que este servicio no constituye un directorio de investigadores, sino información auto referenciada de hojas de vida de personas que declaran estar profesionalmente vinculadas a la CTI en el Perú. Y en ese sentido, tampoco debe ser considerada como una fuente de información para generar estadísticas nacionales de CTI como, por ejemplo, la información académica, la producción científica, la producción tecnológica e industrial, entre otros indicadores. Este sustento ha sido aprobado por el Consejo Directivo del Concytec, previa validación de la Oficina General de Planeamiento y Presupuesto y la Oficina General de Asesoría Jurídica del Concytec. Es necesario manifestar que los argumentos institucionales señalados y la decisión del Concytec de precisar el correcto sentido del anterior servicio conocido como DINA, responden también a la inquietud de los propios usuarios de esta plataforma, así como de la comunidad académica, empresarial, de las entidades públicas y de las instituciones cooperantes.',
            'fecha' => '2019-02-18',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '10.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Peruanos pueden presentar nominaciones para premio UNESCO-Japón sobre educación para el desarrollo sostenible Candidaturas ganadoras recibirán un premio de 50,000 dólares',
            'slug' => Str::slug('Peruanos pueden presentar nominaciones para premio UNESCO-Japón sobre educación para el desarrollo sostenible Candidaturas ganadoras recibirán un premio de 50,000 dólares'),
            'descripcion' => 'Cada Estado Miembro, entre los cuales está el Perú, podrá postular un máximo de tres candidaturas, entre proyectos y programas A fin de generar e incrementar acciones en todos los niveles de educación y aprendizaje que contribuyan a la implementación de los Objetivos de Desarrollo Sostenible (ODS), la UNESCO invita a los Estados Miembros a presentar nominaciones para la quinta Edición del Premio UNESCO-Japón para el Desarrollo Sostenible. Cada Estado Miembro, entre los cuales se encuentra el Perú, podrá presentar un máximo de tres candidaturas individuales, institucionales u organizacionales, las mismas que deberán contar con el respaldo de su Delegación Permanente ante la UNESCO. Las candidaturas, que pueden ser proyectos o programas, deberán cumplir con los siguientes requisitos: Tener por lo menos cuatro años de funcionamiento. Mostrar las evidencias de sus resultados y un alto impacto relacionado con la inversión de sus recursos. Ser replicable y expandido. Contribuir a más de una de las cinco áreas de acción prioritarias del Programa de Acción Global: (avance de políticas, transformación de los aprendizajes y ambientes de capacitación, fortalecimiento de capacidades de educadores y capacitadores, empoderamiento y movilización de jóvenes; y aceleración de soluciones sostenibles en el nivel local). Cada una de las candidaturas seleccionadas a nivel mundial será premiada con 50,000 dólares, previa evaluación sobre los siguientes criterios: Transformación: Prácticas de los Objetivos de Desarrollo Sostenibles como transformadora de la educación en apoyo del desarrollo sostenible, liderando el cambio a nivel individual y social. Integración: Dirigida a las tres dimensiones del Desarrollo Sostenible (sociedad, economía y ambiente) en una manera integrada. Innovación: Permita demostrar un enfoque innovador para los Objetivos de Desarrollo Sostenible. Las personas y/o instituciones interesadas en presentar sus candidaturas y que deseen mayor información pueden ingresar aquí y para preguntas pueden enviar un mensaje al correo electrónico esdprize@unesco.org. Cabe mencionar que las nominaciones serán recibidas hasta el 30 de abril del año en curso, pero los interesados en presentar su candidatura deberán hacerlo máximo con dos semanas de anticipación para que pueda ser revisada, verificada y evaluada por la COMIUNESCO de cada Estado Miembro.',
            'fecha' => '2019-02-13',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '11.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Abren postulaciones para Premios Princesa de Asturias Entre las categorías a ser reconocidas, se incluye la de Investigación Científica y Técnica',
            'slug' => Str::slug('Abren postulaciones para Premios Princesa de Asturias Entre las categorías a ser reconocidas, se incluye la de Investigación Científica y Técnica'),
            'descripcion' => 'Se otorga premio de 50,000 euros. La Fundación Princesa de Asturias, institución privada sin ánimo de lucro, abre la presentación de candidaturas para la nueva edición de los Premios Princesa de Asturias, que reconocen y promueven los valores científicos, culturales y humanísticos. El plazo de presentación de postulaciones finaliza el 14 de marzo de este año. Los premios apuntan a reconocer la labor científica, técnica, cultural, social y humanitaria realizada por personas, instituciones, grupos de personas o de instituciones en el ámbito internacional en ocho categorías: Artes, Letras, Ciencias Sociales, Comunicación y Humanidades, Investigación Científica y Técnica, Cooperación Internacional, Deportes y Concordia. La categoría de Investigación Científica y Técnica se adjudica a quienes realicen labor de cultivo y perfeccionamiento de la investigación, descubrimiento y/o invención en las matemáticas, la astronomía y la astrofísica, la física, la química, las ciencias de la vida, las ciencias médicas, las ciencias de la Tierra y el espacio y las ciencias tecnológicas, así como disciplinas correspondientes a cada uno de dichos campos y de las técnicas relacionadas con ellos. Los premios son entregados por S.M. el Rey Felipe VI en una ceremonia que tiene lugar en octubre, en el Teatro Campoamor de Oviedo. El galardón está dotado de 50,000 euros, una escultura de Joan Miró, un diploma acreditativo y una insignia. Puedes acceder a la plataforma de postulación virtual a través de este enlace.',
            'fecha' => '2019-02-12',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '12.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Con dinámicas frente al mar, científicas motivan vocación de las niñas por las ciencias',
            'slug' => Str::slug('Con dinámicas frente al mar, científicas motivan vocación de las niñas por las ciencias'),
            'descripcion' => 'En el marco del Día Internacional de la Mujer y la Niña en la Ciencia Evento fue organizado por Concytec en coordinación con la Embajada Británica e Instituto Británico Con la finalidad de motivar y promover la presencia de más mujeres en las diferentes áreas de las ciencias, el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) realizó el conversatorio “Hablemos de ciencia frente al mar”, junto a la Embajada Británica y la Asociación Cultura Peruano Británica (Británico). El evento estuvo dirigido por un grupo de destacadas científicas especialistas en biología, química e ingeniería pesquera, que acompañadas de actividades lúdicas y recreativas, transmitieron sus conocimientos, así como sus experiencias profesionales y personales para motivar la vocación por las ciencias a niñas y adolescente -de entre 12 y 14 años- de diversos distritos limeños. La presidenta del Concytec, Fabiola León-Velarde, sostuvo que en el concurso científico escolar Eureka, que organiza el Concytec y el Minedu con estudiantes de todas las regiones del Perú, el 55% de participantes son niñas, y es más o menos el promedio del interés que generan las ciencias entre los escolares de nuestro país. “El reto es mantener esa inquietud y lograr que luego esas niñas sigan una carrera científica, por eso realizamos actividades como esta que nos permite acercarnos a ellas y motivarlas a continuar con su vocación”. Asimismo, dijo que es importante que “las niñas sepan que hay mujeres científicas que trabajan en temas tan importantes como las ciencias del mar y que ganan premios internacionales, los cuales les permiten construir redes con otros países” para realizar proyectos que generen el desarrollo de nuestro país y de la humanidad. En ese sentido, señaló que el Concytec está desarrollando también los clubes de ciencias, para lograr que -en un mediano plazo- el Perú supere el puesto Nº 9 de presencia de mujeres en la ciencia en América Latina. “Tenemos mucho que trabajar, pero en los últimos tres años hemos hecho actividades de promoción que permitieron que en el 2018 se incremente a 40% la presencia de mujeres que ganan los concursos de financiamiento vinculados a la ciencia que otorga el Concytec”, destacó León – Velarde. El evento denominado “Hablemos de ciencia frente al mar” se realizó con motivo de celebrarse el Día Internacional de la Mujer y la Niña en la Ciencia, según lo establecido por las Naciones Unidas el 22 de diciembre de 2015. Las científicas que participaron en este evento son: Giovanna Sotil Caycho: Bióloga con maestría en Recursos Acuáticos. Joanna Alfaro Shigueto: Bióloga con doctorado en Ecología y Conservación. Mónica Gómez León: Química con doctorado en Física. Sara Purca Cuicapusa: Ingeniera pesquera con doctorado en Oceanografía. Zully Puyen Guerra: Bióloga con doctorado en Microbiología. También asistieron el jefe de misión adjunto y cónsul general de la Embajada de Reino Unido en Perú, Colin Gray, y el gerente general del Británico, Gonzalo De Cárdenas, quienes enfatizarán el compromiso de las instituciones que representan por incentivar la vocación científica entre las niñas y adolescentes.',
            'fecha' => '2019-02-11',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '13.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Universidad de Amazonas desarrollará 14 proyectos científico-tecnológicos con financiamiento del Concytec',
            'slug' => Str::slug('Universidad de Amazonas desarrollará 14 proyectos científico-tecnológicos con financiamiento del Concytec'),
            'descripcion' => 'Más de S/ 3 millones para investigación en desarrollo de diversas especies nativas, monitoreo y conservación de agua, entre otros Se trata de la Universidad Nacional Toribio Rodríguez de Mendoza, que es la única casa de estudios superior de Amazonas que accede a dicha subvención El Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) destinará un total de 3 millones 432 mil 702 soles a la región Amazonas para el desarrollo de 14 Proyectos de Investigación Aplicada y Desarrollo Tecnológico, destinados al desarrollo de la industria del café, cacao, tara, berries amazónicos, palma, entre otras especies, además del análisis, monitoreo y potabilización del agua de lluvia. Dicho financiamiento es producto del concurso público que ejecutó Concytec, a través de su unidad ejecutora, Fondecyt, en el marco del convenio con el Banco Mundial, para fomentar la innovación de procesos, el desarrollo de nuevos productos o servicios y otras innovaciones tecnológicas. Los 14 proyectos ganadores en Amazonas son de la Universidad Nacional Toribio Rodríguez de Mendoza (UNTRM), la cual podrá ejecutarlos en un plazo máximo de tres años. Los proyectos ganadores son: Desarrollo de una formula biológica a base de cepas nativas de microorganismos entomopatógenos para reducir la incidencia de broca en plantaciones de cafés especiales. Aprovechamiento de subproductos del procesamiento de berries nativos de la región amazonas para obtener antocianinas y carotenoides utilizando solventes verdes presurizados y su aplicabilidad para mejora la calidad funcional de derivados lácteos. Recubrimiento comestible natural a base de goma de tara para prolongar la vida útil de frutas nativas y hortalizas comerciales. Innovación biotecnológica para la producción masiva de embriones somáticos de cacao fino de aroma en la región Amazonas. Implementación de técnicas de diagnóstico de enfermedades en Pitahaya Tara y Azucena como parte de la creación de la Clínica Fitopatológica en la región Amazonas. Elaboración de cultivos iniciadores de fermentación de café a partir del secuenciamiento metagenómico de comunidades microbianas presentes en la fermentación espontánea de cafés especiales. Disminución de la absorción del cadmio en el cacao peruano mediante la edición genética de sus transportadores empleando la tecnología CRISPR Cas9. Chocolates finos aromatizados y frutados con cacao “Amazonas Perú”. Cuajo natural a base de papaína liofilizada proveniente de diferentes especies nativas del género Vasconcellea en la elaboración de queso. Desarrollo de un fungicida microbiológico a partir de hongos antagonistas nativos para reducir la incidencia y severidad de la moniliasis del cacao nativo fino de aroma. Desarrollo de una tecnología de aprovechamiento de sub productos de la industria palmitera. Obtención de antioxidantes naturales a partir de la pulpa de café para incrementar la vida útil de trucha arco iris eviscerada refrigerada en la región Amazonas. Análisis de la cobertura vegetal, cuerpos de agua, erosión de suelo y monitoreo de invasiones de territorio empleando dos tipos de drones en el área de conservación Conservación Privada Tilacancha. Prototipo de sistema de potabilización del agua de lluvia en comunidades nativas del departamento de Amazonas. Perú 2019 - 2020. El concurso “Proyectos de Investigación Aplicada y Desarrollo Tecnológico” que el Concytec financiará con un monto total de 57 millones de soles, como parte del convenio con el Banco Mundial, tuvo un total de 190 proyectos ganadores que provienen de 20 regiones del país, cuya relación completa puedes conocer aquí.',
            'fecha' => '2019-02-05',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '14.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec y fondo británico financian investigación sobre cambios y riesgos de glaciares peruanos',
            'slug' => Str::slug('Concytec y fondo británico financian investigación sobre cambios y riesgos de glaciares peruanos'),
            'descripcion' => 'Seis investigaciones contarán con más de 8 millones de soles Equipos estarán conformados por investigadores de entidades peruanas y británicas Con la finalidad de generar conocimiento científico y tecnológico sobre el retroceso de los glaciares peruanos y el impacto de los mismos, el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) subvencionará, a través del Fondo Newton-Paulet, 8 millones 995 mil 561 soles para el estudio denominado “Círculo de Investigación en Glaciares”. Revisa aquí a los ganadores Serán seis grupos de investigadores los que accederán a dicho financiamiento, donde los resultados de las investigaciones deberán responder al menos a uno de los siguientes desafíos: Mejorar el conocimiento de los procesos glaciares que controlarán el cambio glaciar y la escorrentía en el futuro en respuesta al cambio climático y la variabilidad climática en el Perú. Determinar cómo será el impacto futuro del retroceso de glaciares en el rol de la escorrentía de glaciares tropicales que provee recursos hídricos a la región. Determinar cómo se pueden gestionar mejor los recursos hídricos para abordar la variación de la demanda en respuesta a los cambios espaciotemporales de la cantidad y calidad del agua. Determinar el potencial de movilización de metales desde la roca debido a la cubierta glacial cambiante y la fuerza e impactos hidrometeorológicos en la calidad del agua, pastos y tierras de cultivo. Comprender el riesgo de los peligros de las montañas, incluyendo fallas en el talud rocoso, inundaciones repentinas avalanchas provenientes de glaciares. El Círculo de Investigación está conformado por investigadores que provienen de tres a cuatro entidades peruanas y, como mínimo, una entidad británica, donde la participación de los investigadores peruanos y británicos deberá ser proporcional en términos de funciones y dedicación al proyecto. Propuestas ganadoras 1. “PEGASUS: Producción de energía y prevención de Hazards desde el almacenamiento de agua de superficie en Perú”, que evaluará las oportunidades y amenazas que los paisajes y recursos naturales traerán a las personas y empresas de las tres cordilleras glaciales de los Andes peruanos: Urubamba, Vilcabamba y Vilcanota. 2. “Pensamiento integrado aguas arriba y aguas abajo para mitigar los desafíos de seguridad hídrica del retiro de los glaciares peruanos, que busca cerrar las brechas y generar un cambio real en la política a través de una combinación de participación de las partes interesadas en eventos geo-climáticos extremos en la cuenca de Santa. 3. “CASCADA: Impactos de escalamiento de la contracción del glaciar peruano en el ciclo biogeoquímico y el drenaje ácido en acuáticos ecosistemas - Toxina o Tratamiento”, que investigará y generará soluciones a los impactos en cascada del retroceso glaciar en la calidad del agua de los ríos de la Cordillera Blanca. 4. Seguridad del agua y adaptación al cambio climático en las cuencas hidrográficas del glaciar peruano (RAHU)” propone abordar los impactos del derretimiento de los glaciares en la cuenca del Vilcanota-Urubamba (Cusco). 5. "Lagunas de origen glaciar en el Perú: evolución, peligros e impacto del cambio climático", el cual responderá preguntas sobre el pasado, presente y futuro de las lagunas de origen glaciar y los peligros asociados a glaciares en las montañas del Perú. 6. “Retiro de glaciares peruanos y su impacto en la seguridad del agua (Perú GROWN)”, busca aumentar la resiliencia de las comunidades y ecosistemas peruanos a los cambios hidrológicos derivados de la disminución de los glaciares en los Andes. Cabe indicar que la convocatoria “Círculo de Investigación en Glaciares” fue gestionada por el Fondecyt, unidad ejecutora del Concytec.',
            'fecha' => '2019-01-18',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '15.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'CONVOCATORIA RPU 2019',
            'slug' => Str::slug('CONVOCATORIA RPU 2019'),
            'descripcion' => '',
            'fecha' => '2019-01-16',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '16.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Impulsarán generación de patentes tecnológicas en Perú',
            'slug' => Str::slug('Impulsarán generación de patentes tecnológicas en Perú'),
            'descripcion' => 'CAF suscribió un convenio de cooperación interinstitucional con el Ministerio de la Producción, Concytec e Indecopi para promover la generación de patentes con potencial comercial, como una herramienta para impulsar la innovación tecnológica, la productividad y el crecimiento del país CAF –banco de desarrollo de América Latina- apoyará al Ministerio de la Producción del Perú, el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) y el Instituto Nacional de Defensa de la Competencia y de la Protección de la Propiedad Intelectual (Indecopi) a promover la generación de patentes en el desarrollo de tecnologías innovadoras que contribuyan a solventar problemas nacionales e internacionales, pero que además impulsen la productividad y el crecimiento económico del país. Mediante el acuerdo interinstitucional, las partes definirán de manera conjunta posibles planes, proyectos, programas de financiamiento y actividades orientadas a incrementar los indicadores de innovación tecnológica como solicitudes y otorgamiento de patentes en mercados nacionales e internacionales, aumentar las regalías y recursos financieros provenientes del licenciamiento o cesión de patentes; así como a incrementar las exportaciones de alta tecnología desde Perú hacia otras regiones del mundo. Al destacar la importancia del convenio, el ministro de la Producción, Raúl Pérez-Reyes, destacó que las patentes y diseños industriales -al brindar exclusividad para la comercialización de una innovación- son instrumentos de protección de la propiedad intelectual que mejoran las oportunidades de ganancia y contrarrestan los efectos de potenciales copias de productos de grandes, medianas y pequeñas empresas que buscan ser más productivas y competitivas a nivel mundial. “Desde el Ministerio de la Producción impulsamos el ecosistema de innovación y emprendimiento para elevar la productividad y competitividad de las empresas en el país. Una empresa peruana que cuente con una o varias patentes o diseños industriales tendrá más posibilidades de incrementar sus ganancias al poseer mejor dominio del mercado, generar el interés de potenciales inversionistas, incluso a escala internacional, para recibir inyección de recursos, entablar relaciones comerciales de licenciamiento y construir estrategias que permitan patentar en los países que constituyan el mercado objetivo de sus innovaciones”, enfatizó. El presidente ejecutivo de CAF, Luis Carranza Ugarte, sostuvo que las patentes son herramientas fundamentales para la protección de los derechos de propiedad industrial y el crecimiento de las economías. En esa línea, Perú tiene grandes desafíos pues para el 2017 los países con más solicitudes internacionales de patentes vía Tratado de Cooperación de Patentes (PCT) fueron: Estados Unidos (56.673 solicitudes), China (48.908), Japón (48.222), Alemania (18.949), y Corea del Sur (15.752). Mientras que los latinoamericanos mejor ubicados son: Brasil (589 solicitudes), México (270), Chile (167) y Colombia (143). Por su parte, Perú presentó 33 solicitudes. “Los países latinoamericanos debemos aspirar a ser más innovadores, productivos, competitivos y dar el gran salto para reducir la brecha tecnológica que nos distancia de naciones industrializadas que reportan altas tasas de crecimiento económico y mejoras en la calidad de vida de sus ciudadanos, entre otros elementos, por su liderazgo en materia de innovación tecnológica”, manifestó Carranza Ugarte. Por su parte, la presidenta del Concytec, Fabiola León-Velarde, refirió que -según el Global Innovation Index 2017- Estados Unidos ocupa el puesto 6 y Chile el lugar 63 del ranking de registro de patentes, mientras que Perú se ubica en el puesto 97.',
            'fecha' => '2019-01-10',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '17.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Investigadores científicos y empresarios de región amazónica buscan solución a baja productividad de cultivos nativos',
            'slug' => Str::slug('Investigadores científicos y empresarios de región amazónica buscan solución a baja productividad de cultivos nativos'),
            'descripcion' => 'Durante encuentro regional organizado por Concytec en Iquitos Coincidieron en priorizar tres ejes de interés: frutales nativos amazónicos, plantas maderables de interés económico y plantas medicinales para mejorar calidad de vida Con la finalidad de mejorar la calidad de vida e ingresos económicos de la población amazónica -mediante la identificación de su problemática y buscando alternativas de solución- el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) organizó el I Encuentro Regional Academia-Industria en Iquitos – Loreto. La reunión, denominada “Desarrollo y Prospectiva de la Biodiversidad y uso de la Biotecnología para la Agroindustria Amazónica”, permitió el intercambio de experiencias entre el empresariado e investigadores para impulsar proyectos de investigación multidisciplinarios e interinstitucionales. En ese sentido, se identificaron tres líneas priorizadas: frutales nativos amazónicos, plantas maderables de interés económico y plantas medicinales para las regiones de Ucayali, San Martín, Huánuco, Madre de Dios y Loreto. Y entre los frutos priorizados figuran el aguaje, camu camu, cocona y castaña; mientras que en las plantas maderables están el huairuro, moena, marupa, bolaina, capirona y umala. También se acordó que las plantas con propiedades anti diabéticas de uso tradicional son las de mayor importancia para la población de la amazonia. El encuentro permitió concluir que los problemas que afrontan los empresarios respecto a los frutales nativos se deben a la baja capacidad productiva, la pobre valorización y débil conexión con el mercado porque no se tiene investigación científica que respalde los cultivos tradicionales. La escasa productividad de plantas de interés maderables se debe a los problemas de acceso y transporte, la falta de un catálogo de especies comerciales, escasa e inadecuada reforestación y utilización de residuos en los procesos productivos. Respecto a la situación actual de las plantas medicinales se tiene conocimiento de sus compuestos activos y proceso biológico, pero falta investigar sobre el perfil químico, estudios de dosificación y definición de presentación como evidencia científica para su adecuado consumo. De otro lado, los participantes mostraron su disposición de trabajar de forma organizada para lograr que la amazonia peruana cuente con sistemas productivos sostenibles. También con investigación aplicada para el desarrollo de tecnologías regionales, transferencia de conocimiento entre la industria y la academia, mejor sistema de colecta y transporte, así como una caracterización más amplia de compuestos bioactivos de los productos nativos de su zona. El encuentro regional fue organizado en coordinación con el Instituto de Investigaciones de la Amazonía Peruana (IIAP) y contó con la participación de investigadores de universidades, institutos y centros de investigación, así como empresarios de Ucayali, San Martín, Huánuco, Madre de Dios y Loreto. Noticias CONCYTEC 79 investigadores irán a 20 países para fortalecer conocimientos en ciencia y tecnología Concytec financia a Universidad Nacional de Trujillo investigación sobre pulpa de café para reducir la anemia infantil Investigador científico Jorge Abad Cueva recibe distinción del Concytec “Santiago Antúnez de Mayolo Gomero” 2018 Ver todas las noticias Noticias CTI Día Internacional de la Seguridad de la Información Chile ofrece beca en diplomado en gestión, ingeniería y ciencias para la resiliencia a los desastres UNESCO premia el empoderamiento digital de personas con habilidades especiales Ver todas las noticias Agenda Participa del campamento de verano en Ciencia e Innovación de Estados Unidos MaCTec Perú: Lanzan becas para talleres de exploración científica gratuitos para niñas Instituto Nacional de Salud del Niño San Borja.',
            'fecha' => '2018-12-18',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '18.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Científicas peruanas serán reconocidas por su relevante aporte a la sociedad',
            'slug' => Str::slug('Científicas peruanas serán reconocidas por su relevante aporte a la sociedad'),
            'descripcion' => 'Serán dos ganadoras que recibirán un premio de 45 mil soles cada una Distinción es promovida por Concytec, L’Oreal, Unesco y la Academia Nacional de Ciencias desde el 2008 Con el objetivo de reconocer la trayectoria y los aportes en la generación del conocimiento y/o en el impacto social a partir de sus investigaciones científicas, el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec), L’ORÈAL, la UNESCO y la Academia Nacional de Ciencias promueven desde el 2008 el Premio Nacional “Por las Mujeres en la Ciencia”. Este premio, que va por su décima edición en el Perú, busca estimular y promover la labor científica de la mujer peruana, cuyos aportes contribuyen a afrontar desafíos planteados a la humanidad en relación a áreas de Ciencias de la Vida, Ciencias Básicas, Ingeniería y Arqueología. A la fecha se han seleccionado a once finalistas con base a su producción científica. Y con la finalidad de hacer visible su trayectoria y esfuerzo, se ha abierto la participación del público a través del voto virtual. No obstante, las dos ganadoras serán definidas por un jurado calificador, integrado por destacados profesionales. Cada ganadora obtendrá un premio de 45,000 soles. Y para la calificación final se tomará en cuenta los siguientes criterios: proporción entre su edad y producción científica, aporte al empoderamiento de otras mujeres investigadoras y región de procedencia. Las personas interesadas en apoyar a sus candidatas pueden hacerlo aquí hasta el 31 de enero del 2019. El concurso inició el 15 de agosto pasado con 28 postulantes, todas ellas con el grado académico de doctora que pasaron una evaluación exhaustiva por parte del jurado calificador. Cabe indicar que las dos científicas peruanas destacadas que resulten ganadoras de este reconocimiento podrán participar del Premio Global que ofrecen L’Oreal y Unesco con las ganadoras de otros países. El Premio Nacional “Por las Mujeres en la Ciencia” se instauró en el 2008 y ha permitido reconocer el trabajo de 20 mujeres de distintas regiones del país, que a través de sus investigaciones científicas y/o tecnológicas buscan atender los problemas y/o necesidades de interés nacional. De esta forma, el Concytec, L’Oréal, UNESCO y la Academia Nacional de la Ciencia suman esfuerzos para seguir promoviendo la participación de la mujer en la ciencia y poner en valor el aporte científico que puede generar una mirada inclusiva en la ciencia. Noticias CONCYTEC 79 investigadores irán a 20 países para fortalecer conocimientos en ciencia y tecnología Concytec financia a Universidad Nacional de Trujillo investigación sobre pulpa de café para reducir la anemia infantil Investigador científico Jorge Abad Cueva recibe distinción del Concytec “Santiago Antúnez de Mayolo Gomero” 2018 Ver todas las noticias Noticias CTI Día Internacional de la Seguridad de la Información Chile ofrece beca en diplomado en gestión, ingeniería y ciencias para la resiliencia a los desastres UNESCO premia el empoderamiento digital de personas con habilidades especiales Ver todas las noticias Agenda Participa del campamento de verano en Ciencia e Innovación de Estados Unidos MaCTec Perú: Lanzan becas para talleres de exploración científica gratuitos para niñas Instituto Nacional de Salud del Niño San Borja realiza primera jornada de innovación en pediatría.',
            'fecha' => '2018-12-21',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '19.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => '79 investigadores irán a 20 países para fortalecer conocimientos en ciencia y tecnología',
            'slug' => Str::slug('79 investigadores irán a 20 países para fortalecer conocimientos en ciencia y tecnología'),
            'descripcion' => 'Con financiamiento del Concytec por más de S/ 1 millón Financiamiento permitirá cubrir gastos del viaje, el cual varía entre 14 y 90 días El Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) aprobó la subvención de 1 millón 170 mil soles para fortalecer las capacidades en Investigación Científica, Desarrollo Tecnológico o Innovación Tecnológica (I+D+i) de 79 profesionales, quienes, para ello, tendrán la oportunidad de viajar a 20 países, además de Perú. Los beneficiados provienen de 19 regiones del Perú, y accedieron a un financiamiento que fluctúa entre 3 mil y 27 mil soles, a través de la convocatoria “Movilización en Ciencia, Tecnología e Innovación Tecnológica – Pasantías”, promovida por el Fondecyt, unidad ejecutora del Concytec. Ellos se involucrarán en una formación académica o el desarrollo de proyectos en universidades o instituciones que fomentan la ciencia y la tecnología a partir del intercambio de conocimiento, tanto entre regiones del Perú, como otros 20 países, que son: Argentina, Austria, Bélgica, Brasil, Colombia, Chile, Dinamarca, Estados Unidos, España, Francia, Italia, México, Nueva Zelanda, Países Bajos, Portugal, Reino Unido, República Checa, Suecia y Uruguay. Dicha subvención cubre los gastos del viaje (pasaje, seguro y manutención), sea en el Perú o el extranjero, por un plazo mínimo de 14 días y máximo de 90 días calendario, y tiene como sectores prioritarios de investigación: Ciencias y tecnologías ambientales Ciencia de la vida y biotecnología Ciencias básicas Ciencias y tecnologías ambientales Tecnologías de información y comunicación Ciencia y tecnología de materiales Cabe indicar que de los 79 beneficiaros, 22 son mujeres y 57 varones, entre cuyos proyectos de investigación figuran: “Efecto del cambio climático sobre la distribución de especies de aves amenazadas del Perú”, “Respuesta de arándanos a inductores de resistencia y su efecto contra el ataque de plagas” y “Generación de electricidad mediante asociaciones planta-bacteria en humedales de remediación y su potencial uso en zonas altoandinas”. Además, “Mejora de capital humano en TIC para la gestión productiva, aplicado a eficiencia energética en sistema de frío del sector agroindustrial”, “Calibración de un nuevo proxy I/CA (yodo/calcio) para reconstrucciones de cambios en la oxigenación del mar peruano producto del cambio climático” y “Colaboración en sistemas de medición y caracterización de antenas y metamateriales”.',
            'fecha' => '2018-12-31',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '20.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec financia a Universidad Nacional de Trujillo investigación sobre pulpa de café para reducir la anemia infantil',
            'slug' => Str::slug('Concytec financia a Universidad Nacional de Trujillo investigación sobre pulpa de café para reducir la anemia infantil'),
            'descripcion' => 'poblaciones vulnerables, así como a 223 mil familias cafetaleras Por su alto valor nutricional, la pulpa del café ha sido seleccionada por un equipo multidisciplinario de la Universidad Nacional de Trujillo (UNT) como una alternativa alimenticia para combatir la desnutrición y reducir la anemia infantil en las poblaciones vulnerables del Perú. Este proyecto fue presentado a la convocatoria de “Proyectos de Investigación Aplicada y Desarrollo Tecnológico 2018”, que financia el Concytec en convenio con el Banco Mundial, y ha sido seleccionado entre los 190 ganadores, por lo que recibirán una subvención de 500 mil soles. El concurso, que estuvo a cargo del Fondecyt (unidad ejecutora del Concytec), tiene como objetivo fomentar la innovación de procesos, el desarrollo de nuevos productos o servicios u otras innovaciones tecnológicas. Los 190 proyectos ganadores provienen de 20 regiones y el financiamiento total bordea los 57 millones de soles. La investigación sobre pulpa de café Carmen Marín Tello, investigadora principal del proyecto, sostiene que las muestras evaluadas, controladas y seguras de pulpa de café para el consumo humano -estudiadas en la universidad- serán formuladas en un producto alimenticio por el Centro de Investigación Tecnológica Agroindustrial Chavimochic. Asegura que la presentación del producto será atractiva para el paladar, especialmente de los niños. Tomando en cuenta que alrededor del 43% de los infantes tiene anemia en el Perú, la investigadora se plantea que aproximadamente 4 millones de los 10 millones 338 mil niños se beneficiarían con este proyecto. De acuerdo a registros entre la población de Lonya Grande, en la provincia de Utcubamba, en Amazonas, el consumo de galletas artesanales hechas con harina de pulpa de café permitieron mejorar la hemoglobina en sangre en comparación a aquellos que no consumen este producto. No obstante, refiere Marín Tello, investigadores de la Escuela de Farmacia y Bioquímica y del Departamento de Agroalimentaria de la Universidad realizarán un estudio que permitirá verificar si el incremento de la hemoglobina se debe al consumo de la pulpa de café o a otros ingredientes. Indica también que se evaluarán los componentes nutricionales y tóxicos que podrían estar presentes, además de realizar pruebas pre clínicas en animales de experimentación y en humanos voluntarios, dentro del marco ético y con procesos de aseguramiento de la calidad. Más de 220 mil familias beneficiadas De otro lado, la investigación también beneficiará de forma directa a 223 mil familias cafetaleras de Junín, San Martín y Amazonas, que tienen como sustento primario el cultivo de café, donde el 15% de las hectáreas son administradas por mujeres. Además, generará un impacto positivo en las poblaciones de dichas regiones porque sus ríos y áreas de tierra ya no serán cubiertos con este tipo de deshecho, que generan deterioro de los suelos y contaminación de quebradas y del agua, según un informe del Programa de las Naciones Unidas para el Desarrollo (PNUD 2018).',
            'fecha' => '2018-12-28',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '21.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Investigador científico Jorge Abad Cueva recibe distinción del Concytec “Santiago Antúnez de Mayolo Gomero” 2018 Por su estudio de los ríos amazónicos y otros aportes en ingeniería civil y ambiental',
            'slug' => Str::slug('Investigador científico Jorge Abad Cueva recibe distinción del Concytec “Santiago Antúnez de Mayolo Gomero” 2018 Por su estudio de los ríos amazónicos y otros aportes en ingeniería civil y ambiental'),
            'descripcion' => 'Candidatura fue presentada por Universidad de Ingeniería y Tecnología en la categoría “Investigador que contribuye a la investigación en ciencia” En una ceremonia presidida por la Dra. Fabiola León-Velarde, presidenta del Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec), el Dr. Jorge Darwin Abad Cueva recibió hoy la distinción al mérito “Santiago Antúnez de Mayolo Gomero” 2018, en la categoría “Investigador que contribuye a la investigación en ciencia”. La Dra. León-Velarde sostuvo que esta distinción es “en mérito a su esfuerzo de poner la ciencia al servicio de la ciudadanía. No solo para solucionar problemas coyunturales, sino para prevenir las emergencias que cada año nos aquejan, como los fenómenos naturales”, lo que permite un mayor impacto en la sociedad. Por su parte, el Dr. Abad agradeció la distinción recibida del Concytec en reconocimiento a su trabajo de investigación “el cual no hubiera sido posible sin el apoyo de mi familia”. Además, dijo no sentirse en la cúspide de su carrera porque “creo que me falta mucho por hacer”. Este reconocimiento se instauró en el 2013, mediante la Ley 3008, y establece que el Concytec debe otorgar tal distinción anualmente a los ciudadanos peruanos que, como resultado de sus trabajos e investigadores, contribuyan al desarrollo de la ciencia, la tecnología y la innovación tecnológica. La postulación del Dr. Abad Cueva fue presentada por la Universidad de Ingeniería y Tecnología (UTEC), cuyas autoridades tuvieron en cuenta los méritos y requisitos necesarios para que pueda optar por la referida distinción en la categoría de “Investigador que contribuye a la investigación en ciencia”. El Dr. Abad Cueva es director académico de CREAR (Center for Research and Education of the Amazonian Rainforest), director del Centro de Investigación y Tecnología del Agua (CITA), y director académico de la Universidad de Ingeniería y Tecnología (UTEC). Además, es autor de tres capítulos de libros, más de 30 publicaciones en revistas internacionales y más de 65 artículos de conferencias. Tiene amplia experiencia en investigación de la geomorfología y transporte de sedimentos, con especialización en ríos amazónicos, cuyos trabajos son reconocidos en revistas especializadas, tales como Discovery, EcoAméricas y Mongabay. También recibió el B.Sc. en Ingeniería Civil de la Universidad Nacional de Ingeniería, Lima, Perú, el MSc y Doctor en Ingeniería Civil y Ambiental de la Universidad de Illinois en Urbana- Champaign, EE.UU., y fue, también, investigador post-doctoral en la Universidad de Illinois. Distinción al Mérito La distinción al mérito “Santiago Antúnez de Mayolo Gomero” es otorgada en tres categorías: Medalla de la Orden del Mérito Santiago Antúnez de Mayolo Gomero a la investigación en ciencia. Medalla de la Orden del Mérito Santiago Antúnez de Mayolo Gomero a la investigación en tecnología. Medalla de la Orden del Mérito Santiago Antúnez de Mayolo Gomero a la investigación en innovación tecnológica. En el caso de las otras dos categorías que forman parte de este reconocimiento: “Investigador que contribuye a la investigación en tecnología” e “Investigador que contribuye a la investigación en innovación tecnológica”, fueron declaradas desiertas por los miembros de la Comisión de Aprobación, conforme a los criterios técnicos y científicos establecidos en las bases, así como la evaluación y análisis de la información remitida de los trabajos e investigaciones presentados. De acuerdo a las bases, las propuestas para el otorgamiento de la presente distinción son presentadas por los congresistas de la República, las universidades, los institutos de investigación, los colegios profesionales y las organizaciones de las empresas privadas.',
            'fecha' => '2018-12-27',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '22.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec subvenciona 190 proyectos de investigación científica en 20 regiones, por S/ 57 millones',
            'slug' => Str::slug('Concytec subvenciona 190 proyectos de investigación científica en 20 regiones, por S/ 57 millones'),
            'descripcion' => 'La mayoría de proyectos ganadores provienen de regiones Se otorga subvención de hasta S/ 500,0000 por proyecto Proyectos de investigación como la creación de sustitutos biodegradables de bolsas plásticas, el estudio de bacterias salinas en la búsqueda de nuevos anticancerígenos, así como el diseño de un sistema de recuperación de áreas degradadas por la minería en la selva de Madre de Dios, forman parte de las 190 iniciativas que serán financiadas por el Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) con un monto de alrededor de S/ 57 millones de soles. REVISA AQUÍ LA LISTA DE SELECCIONADOS Este desembolso se enmarca en la convocatoria Proyectos de Investigación Aplicada y Desarrollo Tecnológico 2018, como parte del convenio del Concytec con el Banco Mundial. Los 190 proyectos que se financiarán provienen de 58 universidades y centros de investigación, entre públicos y privados, provenientes de 20 regiones, y cada uno obtendrá una subvención de hasta S/ 500,000. Más del 45% de iniciativas postularon bajo la modalidad de proyectos en etapa avanzada. La convocatoria, a cargo del Fondecyt (unidad ejecutora del Concytec), tiene como objetivo fomentar la innovación de procesos, el desarrollo de nuevos productos o servicios u otras innovaciones tecnológicas, mediante un financiamiento general. Los 190 proyectos Cabe señalar que, en respuesta a las actividades de información descentralizada, en esta convocatoria la mayor parte de proyectos ganadores provienen de las regiones (54%). Lima concentra el otro 46%, a diferencia de anteriores concursos en los que solía concentrar alrededor del 70% de las subvenciones. En ese sentido, se observa una participación significativa en los casos de La Libertad (18 proyectos), Amazonas (14), Arequipa (12), Piura (9) y Loreto (9). La mitad de las propuestas ganadoras atienden, principalmente, la demanda de los siguientes sectores generales: 1) Salud, 2) Ambiente; 3) Agropecuario; 4) Energía; 5) Vivienda y Saneamiento; 6) Educación 7) Telecomunicaciones y 8) Metalurgia. La otra mitad de subvenciones es para proyectos enfocados en los siguientes sectores estratégicos: 1) Agroindustria y elaboración de alimentos; 2) Manufactura Avanzada; 3) Ecoturismo, Restauración e Industrias Creativas; 4) Forestal Maderable; 5) Minería y su Manufactura; y 6) Textil y Confecciones. A nivel de regiones, los subsectores con más proyectos ganadores son: Agroindustria y elaboración de alimentos (29), seguido por el de Ambiente (15), Salud (13), Agropecuario (13) y Forestal Maderable (9), entre otros. Es importante destacar también que en este concurso se incentivó tanto la participación de la mujer investigadora, como de investigadores jóvenes (menores de 35 años), otorgándose un bono a aquellos proyectos que -ante igual calidad respecto a otros- los incluyeron en sus propuestas de investigación. El plazo máximo de ejecución de los proyectos subvencionados es de 3 años, durante los cuales el Concytec realizará un estricto seguimiento a las respectivas instituciones ganadoras.',
            'fecha' => '2018-12-21',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '23.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Hungría ofrece becas de estudio para programas de licenciatura, maestría y doctorado Plazo para postular vence el 15 de enero',
            'slug' => Str::slug('Hungría ofrece becas de estudio para programas de licenciatura, maestría y doctorado Plazo para postular vence el 15 de enero'),
            'descripcion' => 'nteresados deberán postular a subvención a través del Pronabec El gobierno de Hungría ofrece al Perú, a través de la Plataforma de Movilidad Estudiantil y Académica de la Alianza del Pacífico, dos becas para realizar estudios de licenciatura, maestría, doctorado o cursos de preparación y especialización. La beca incluye la matrícula, alojamiento, seguro médico y estipendio mensual que comprende entre los 130 euros y 580 euros mensuales, dependiendo del programa al que acceda el beneficiado. Entre los requisitos que deben presentar las personas interesadas figuran: formulario de postulación online, carta motivos, demostración de dominio del idioma y las traducciones en el idioma seleccionado para el programa de estudio o en idioma húngaro. Además, las transcripciones de calificaciones y las traducciones en el idioma seleccionado para el programa de estudio o en idioma húngaro, certificado médico, copia del documento de identidad o pasaporte y declaración de postulación firmada. Las personas interesadas en esta iniciativa tienen plazo para postular hasta el 15 de enero de 2019, y en caso deseen mayor información pueden escribir al correo electrónico balianza.pacifico@pronabec.edu.pe. Cabe indicar que en el Perú las becas serán gestionadas a través del Programa Nacional de Becas y Crédito Educativo (Pronabec) y pueden obtener mayor información en: http://studyinhungary.hu/study-in-hungary/menu/stipendium-hungaricum-scholarship-programme',
            'fecha' => '2018-12-17',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '24.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Universidad Laurentian ofrece vacantes para investigadores en Geología, Geofísica y Geometalúrgica Interesados pueden postular hasta el 31 de enero de 2019',
            'slug' => Str::slug('Universidad Laurentian ofrece vacantes para investigadores en Geología, Geofísica y Geometalúrgica Interesados pueden postular hasta el 31 de enero de 2019'),
            'descripcion' => 'Se trata de cinco puestos para proyectos de investigación que serán financiados durante tres años Profesionales en las áreas de geología, geofísica y geometalúrgica que hayan concluido sus estudios de doctorado pueden postular a una de las cinco vacantes para investigador asociado que ofrece el Mineral Exploration Research Centre (MERC), a través de la Cámara de Comercio de Canadá. Se trata de tres vacantes para supervisar y realizar investigaciones basadas en mapeo, una vacante para geofísica en exploración aplicada y una última plaza para la compañía Battery Mineral Resources Ltda, ofrecidas por la Universidad Laurentian. Las personas seleccionadas trabajarán en el Metal Earth, un proyecto de investigación que busca identificar y entender los procesos geológicos, geofísicos y geometalúrgicos que pretende transformar la comprensión de la evolución temprana de la Tierra y la forma en que exploramos en la búsqueda de metales y minerales en general. Los profesionales de las carreras antes mencionadas que estén interesados en postular a alguna de las vacantes, tienen plazo hasta el 31 de enero de 2019, enviando un correo electrónico a la señora Courtney Folz al cfolz@laurentian.ca. Para mayor información pueden ingresar a la siguiente dirección: https://www.researchgate.net/  job/920894_PDF_Research_Associate. Todas las solicitudes deben incluir una carta de interés y currículum vitae actualizado, ambos en inglés, así como información de contacto de tres referencias. También deben demostrar excelencia en trabajos de investigación. El rango salarial es entre 65 mil y 80 mil dólares canadienses. MERC es un centro de investigación semiautónomo en geociencias para la exploración de la Universidad Laurentian, que trabaja en depósitos minerales, geología precámbrica y metodología está relacionado con la minería. Además, está integrado por un grupo de investigadores de la academia, industria y gobierno reconocidos internacionalmente.',
            'fecha' => '2018-12-17',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '25.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Concytec reconoce a Jorge Darwin Abad Cueva por su contribución a la investigación en ciencia En distinción al mérito “Santiago Antúnez de Mayolo Gomero 2018” Ceremonia de premiación será jueves 27 de diciembre',
            'slug' => Str::slug('Concytec reconoce a Jorge Darwin Abad Cueva por su contribución a la investigación en ciencia En distinción al mérito “Santiago Antúnez de Mayolo Gomero 2018” Ceremonia de premiación será jueves 27 de diciembre'),
            'descripcion' => 'El Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec) otorgará la distinción al mérito “Santiago Antúnez de Mayolo Gomero 2018” al Dr. Jorge Darwin Abad Cueva, en la categoría “Investigador que contribuye a la investigación en ciencia”. Las otras dos categorías que forman parte de esta distinción: “Investigador que contribuye a la investigación en tecnología” e “Investigador que contribuye a la investigación en innovación tecnológica”, fueron declaradas desiertas por los miembros de la Comisión de Aprobación, conforme a los criterios técnicos y científicos establecidos en las bases, así como la evaluación y análisis de la información remitida de los trabajos e investigaciones presentados. La ceremonia de reconocimiento al destacado investigador peruano, que sobresalió junto a otros seis competidores, será el jueves 27 de diciembre y estará a cargo da la presidenta del Concytec, Dra. Fabiola León-Velarde. El Dr. Abad recibió el B.Sc. en Ingeniería Civil de la Universidad Nacional de Ingeniería, Lima, Perú, el MSc y Doctor en Ingeniería Civil y Ambiental de la Universidad de Illinois en Urbana- Champaign, EE.UU., y fue, también, investigador post-doctoral en la Universidad de Illinois. Además, es autor de tres capítulos de libros, más de 30 publicaciones en revistas internacionales y más de 65 artículos de conferencias. Cuenta con amplia experiencia en investigación de la geomorfología y transporte de sedimentos, con especialización en ríos amazónicos, cuyos trabajos son reconocidos en revistas especializadas, tales como Discovery, EcoAméricas y Mongabay. Actualmente, es el director académico de CREAR (Center for Research and Education of the Amazonian Rainforest), director del Centro de Investigación y Tecnología del Agua (CITA), y director académico de la Universidad de Ingeniería y Tecnología (UTEC). Distinción al Mérito El 10 de octubre pasado el Concytec abrió la convocatoria para acceder a la Distinción al Mérito “Santiago Antúnez de Mayolo Gomero – 2018”, con la finalidad de reconocer la trayectoria del investigador peruano que contribuye al desarrollo de la ciencia, la tecnología o la innovación tecnológica en el Perú. Desde el 10 de octubre hasta el 15 de noviembre, los ciudadanos peruanos en ejercicio, mayores de 18 años que, como resultado de sus trabajos e investigaciones hayan contribuido a la investigación en ciencia, tecnología o innovación tecnológica, postularon a dicho reconocimiento, que se creó mediante Ley Nº 30008. Entre los criterios a evaluar por la Comisión de Aprobación figuraron: la trascendencia e impacto de las investigaciones; la extensión y continuidad de sus actividades relacionadas a la investigación, así como el desarrollo tecnológico y la innovación. Dicho grupo evaluador estuvo integrado por la presidenta del Concytec y el presidente de la Comisión de Ciencia, Innovación y Tecnología del Congreso de la República. También por un representante del Consejo Nacional de Competitividad, un representante del Ministerio al que corresponda la investigación, un representante del Instituto Nacional de Defensa de la Competencia y de la Protección de la Propiedad Intelectual (Indecopi), y un representante de las asociaciones de universidades activas en investigación, desarrollo tecnológico e innovación.',
            'fecha' => '2018-12-18',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '26.jpg',
            'main' => 0,
        ]);
        $new = App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'II CONVOCATORIA - Proyectos de investigación con uso de recursos ordinarios 2017',
            'slug' => Str::slug('II CONVOCATORIA - Proyectos de investigación con uso de recursos ordinarios 2017'),
            'descripcion' => '',
            'fecha' => '2017-11-28',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '43.png',
            'main' => 0,
        ]);
        $new->files()->create([
            'name' => 'II CONVOCATORIA - Proyectos de investigación con uso de recursos ordinarios 2017',
            'path' => '43.pdf',
        ]);
        $new = App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Taller de capacitación para investigadores en elaboración de proyectos y lineas de investigación',
            'slug' => Str::slug('Taller de capacitación para investigadores en elaboración de proyectos y lineas de investigación'),
            'descripcion' => '',
            'fecha' => '2017-11-28',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ]);
        $new->images()->create([
            'name' => 'imagen',
            'path' => '44.jpg',
            'main' => 0,
        ]);
        $new->files()->create([
            'name' => 'Taller de capacitación para investigadores en elaboración de proyectos y lineas de investigación',
            'path' => '44.pdf',
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'DIRECTOR DEL INSTITUTO DE INVESTIGACIÓN',
            'slug' => Str::slug('DIRECTOR DEL INSTITUTO DE INVESTIGACIÓN'),
            'descripcion' => 'Ingeniero Agrícola dedicado al diseño, Gestión, Evaluación de Impacto ambiental e investigación científica de obras hidráulicas, hidrología e Hidroeconomía. Maestro en Ciencias e Ingeniería - Gestión Ambiental, doctor economía, y Doctor en ingeniería ambiental.',
            'fecha' => '2017-11-07',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '45.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 1,
            'titulo' => 'Curso Taller Internacional: Evaluación del impacto de la variable climática en la producción y manejo del cultivo de maíz',
            'slug' => Str::slug('Curso Taller Internacional: Evaluación del impacto de la variable climática en la producción y manejo del cultivo de maíz'),
            'descripcion' => '',
            'fecha' => '2017-04-17',
            'lugar' => '',
            'dirigido' => '',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '46.png',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 2,
            'titulo' => 'CONCURSO DE PROYECTOS DE INVESTIGACIÓN CON USO DE RECURSOS ORDINARIOS 2019',
            'slug' => Str::slug('CONCURSO DE PROYECTOS DE INVESTIGACIÓN CON USO DE RECURSOS ORDINARIOS 2019'),
            'descripcion' => '',
            'fecha' => '2019-08-14',
            'lugar' => 'UNASAM',
            'dirigido' => 'Investigadores de la UNASAM',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '01.jpg',
            'main' => 0,
        ]);
        App\Comunicado::create([
            'user_id' => 2,
            'tipo' => 2,
            'titulo' => 'VIII CONCURSO DE PROYECTOS DE INVESTIGACIÓN CON USO DE RECURSOS DETERMINADOS - CANON, SOBRECANON Y REGALÍAS CON FINES DE INVESTIGACIÓN 2019',
            'slug' => Str::slug('VIII CONCURSO DE PROYECTOS DE INVESTIGACIÓN CON USO DE RECURSOS DETERMINADOS - CANON, SOBRECANON Y REGALÍAS CON FINES DE INVESTIGACIÓN 2019'),
            'descripcion' => '',
            'fecha' => '2019-08-09',
            'lugar' => 'UNASAM',
            'dirigido' => 'Investigadores de la UNASAM',
            'main' => 0,
            'active' => 1,
        ])->images()->create([
            'name' => 'imagen',
            'path' => '02.jpg',
            'main' => 0,
        ]);

        App\TipoInstitucion::create([
            'user_id' => 2,
            'nombre' => 'Universidades',
            'slug' => Str::slug('Universidades'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoInstitucion::create([
            'user_id' => 2,
            'nombre' => 'Instituciones',
            'slug' => Str::slug('Instituciones'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoInstitucion::create([
            'user_id' => 2,
            'nombre' => 'Comunidades',
            'slug' => Str::slug('Comunidades'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoInstitucion::create([
            'user_id' => 2,
            'nombre' => 'Municipalidades',
            'slug' => Str::slug('Municipalidades'),
            'main' => 0,
            'active' => 1,
        ]);

        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2017',
            'periodo' => 'I',
            'slug' => Str::slug('2017 I'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2017',
            'periodo' => 'II',
            'slug' => Str::slug('2017 II'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2018',
            'periodo' => 'I',
            'slug' => Str::slug('2018 I'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2018',
            'periodo' => 'II',
            'slug' => Str::slug('2018 II'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2019',
            'periodo' => 'I',
            'slug' => Str::slug('2019 I'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2019',
            'periodo' => 'II',
            'slug' => Str::slug('2019 II'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2020',
            'periodo' => 'I',
            'slug' => Str::slug('2020 I'),
            'main' => 0,
            'active' => 1,
        ]);
        App\Semestre::create([
            'user_id' => 2,
            'anio' => '2020',
            'periodo' => 'II',
            'slug' => Str::slug('2020 II'),
            'main' => 0,
            'active' => 1,
        ]);

        App\TipoConvocatoria::create([
            'id' => 2,
            'user_id' => 2,
            'nombre' => 'Convocatoria de Articulos de Investigación',
            'slug' => Str::slug('Convocatoria de Articulos de Investigación'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvocatoria::create([
            'id' => 3,
            'user_id' => 2,
            'nombre' => 'Convocatoria de Eventos Académicos',
            'slug' => Str::slug('Convocatoria de Eventos Académicos'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvocatoria::create([
            'id' => 4,
            'user_id' => 2,
            'nombre' => 'Recursos Ordinarios',
            'slug' => Str::slug('Recursos Ordinarios'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvocatoria::create([
            'id' => 5,
            'user_id' => 2,
            'nombre' => 'Canon, Sobre Canon y Regalías',
            'slug' => Str::slug('Canon, Sobre Canon y Regalías'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvocatoria::create([
            'id' => 6,
            'user_id' => 2,
            'nombre' => 'Otras Convocatorias de Investigacion',
            'slug' => Str::slug('Otras Convocatorias de Investigacion'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoConvocatoria::create([
            'id' => 7,
            'user_id' => 2,
            'nombre' => 'Convocatoria de Emprendimiento',
            'slug' => Str::slug('Convocatoria de Emprendimiento'),
            'main' => 0,
            'active' => 1,
        ]);

        App\TipoFinanciacion::create([
            'user_id' => 2,
            'nombre' => 'Recursos Ordinarios',
            'slug' => Str::slug('Recursos Ordinarios'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoFinanciacion::create([
            'user_id' => 2,
            'nombre' => 'Canon',
            'slug' => Str::slug('Canon'),
            'main' => 0,
            'active' => 1,
        ]);
        App\TipoFinanciacion::create([
            'user_id' => 2,
            'nombre' => 'Otro',
            'slug' => Str::slug('Otro'),
            'main' => 0,
            'active' => 1,
        ]);
    }
}
