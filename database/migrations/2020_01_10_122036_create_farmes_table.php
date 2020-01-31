<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('wilaya');
            $table->string('dede');
            $table->enum('place_people', ['nearby', 'far']);
            $table->enum('admin', ['me', 'other']);
            $table->enum('educ_level', ['primaire', 'seam','laicy','mihani','univ']);
            $table->enum('tarbiya_aranib', ['morabi', 'ma3had','taraboss','self']);
            $table->string('year_takwin');
            $table->string('lenght_takwin');
            $table->integer('number_employe');
            //
            $table->enum('arnab', ['hajin', 'santitik','geant', 'other']);
            $table->string('date_imtilak');
            $table->string('why_imtilak');
            $table->string('numbers_fathers');
            $table->string('numbers_mothers');
            $table->float('prix_mothers');
            $table->enum('amrad', ['tanafos', 'hadmi','virus', 'bec']);
            $table->integer('darwa_intaj');
            $table->string('date_tajdid');
            $table->enum('rat_intaj', ['mokathaf', 'nisf_mokathaf','3achwai']);
            $table->string('3omr_intaj');
            $table->enum('naw3_talki7', ['tabi3i','istina3i']);
            $table->string('3omr_fitam');
            $table->integer('motawasit_intaj');
            $table->enum('nisbat_wafayat', ['fawk5','ta7t5']);
            //
            $table->integer('number_ambars');
            $table->integer('missa7a_ambar');
            $table->enum('kahraba', ['yes','no']);
            $table->enum('gaz', ['yes','no']);
            $table->enum('water', ['yes','no']);
            $table->enum('khazan_water', ['yes','no']);
            $table->integer('khazan_water_si3a');
            $table->enum('madba7_wilay', ['yes','no']);
            $table->string('util_7arara_tahwiya');
            $table->integer('numbers_akfas');
            $table->integer('numbers_akfas_mother');
            $table->integer('numbers_akfas_father');
            $table->integer('numbers_akfas_tasmin');
            $table->enum('naw3iya_akfas', ['mostawrad','ma7ali']);
            //
            $table->enum('mossani3_3ilf', ['kharboch','sim','wachfon','other']);
            $table->enum('tasta3mil_idafa_okhra', ['yes','no']);
            $table->enum('tarika_chiraa', ['derect','mowazi3_a','mowazi3_b']);
            $table->float('prix_kintar');
            $table->enum('masa3ib_3ilf', ['bo3d_massafa','prix_ghali','kilat_mowazi3in','tadabdob_intaj']);
            //
            $table->integer('3adad_bayatira');
            $table->enum('mantojat_saydalaniya', ['yes','no']);
            $table->string('mantojat_saydalaniya_why_no');
            $table->string('mantojat_saydalaniya_why_yes');
            $table->enum('talki7', ['koklafaks','parfak','vhd1','vhd2']);
            $table->float('prix_talki7');
            $table->string('adwiya_mosta3mala');
            $table->string('mo3akimat_mosta3mala');
            $table->enum('i3timad_si7i', ['yes','no']);
            //
            $table->float('motawassit_wazn_bay3');
            $table->enum('bay3', ['arnab','mizan']);
            $table->float('prix_bay3_mizan');
            $table->float('prix_bay3_arnab');
            $table->enum('ayna_bay3', ['dakhil_ambar','kharij_ambar']);


            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmes');
    }
}
