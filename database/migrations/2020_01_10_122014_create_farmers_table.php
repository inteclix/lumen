<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
        // farmer
            $table->bigIncrements('id');
            $table->integer('farmer_number');
            $table->boolean('farmer_monkharit');
            $table->enum('farmer_sex', ['home', 'woman']);
            $table->string('farmer_last_name');
            $table->string('farmer_first_name');
            $table->string('farmer_birth_day');
            $table->string('farmer_address');
            $table->string('farmer_tel');
            $table->string('farmer_job');
            $table->boolean('farmer_morabi_card');
            $table->enum('farmer_level_educ', ['primaire', 'seam','laicy','mihani','univ']);
        // mazra3a
            $table->string('farm_name');
            $table->string('farm_address');
            $table->string('farm_wilaya');
            $table->string('farm_year_begin');
            $table->string('farm_7ala');
            $table->enum('farm_position_people', ['nearby', 'far']);
            $table->enum('farm_geran', ['me', 'other']);
            $table->enum('farm_geran_level_edcu', ['primaire', 'seam','laicy','mihani','univ']);
            $table->enum('farm_takwin_tarbiyat_aranib', ['morabi', 'ma3had','taraboss','self']);
            $table->string('farm_takwin_tarbiyat_aranib_year');
            $table->string('farm_takwin_tarbiyat_aranib_duree');
            $table->integer('farm_number_employe');
        // aranib
            $table->enum('arnab_solala', ['hajin', 'santitik','geant', 'other']);
            $table->string('arnab_date_imtilak');
            $table->string('arnab_imtilak_why');
            $table->string('arnab_number_mothers');
            $table->string('arnab_number_fathers');
            $table->float('arnab_mothers_prix');
            $table->float('arnab_fathers_prix');
            $table->enum('arnab_amrad', ['tanafos', 'hadmi','virus', 'bec']);
            $table->integer('arnab_darwa_intaj');
            $table->string('arnab_date_tajdid_kati3');
            $table->enum('arnab_ratm_intaj', ['mokathaf', 'nisf_mokathaf','3achwai']);
            $table->string('arnab_3omr_intaj');
            $table->enum('arnab_naw3_talki7', ['tabi3i','istina3i']);
            $table->string('arnab_3omr_fitam');
            $table->integer('arnab_motawassit_intaj');
            $table->enum('arnab_nissbat_wafayat', ['fawk5','ta7t5']);
        // mo3idat tarbiya
            $table->integer('mo3idat_numbers_ambar');
            $table->integer('mo3idat_missa7a_ambar');
            $table->enum('mo3idat_elect', ['yes','no']);
            $table->enum('mo3idat_gaz', ['yes','no']);
            $table->enum('mo3idat_eau', ['yes','no']);
            $table->enum('mo3idat_khazan_eau', ['yes','no']);
            $table->integer('mo3idat_khazan_eau_si3a');
            $table->enum('mo3idat_madba7_wilaya', ['yes','no']);
            $table->string('mo3idat_mosta3mala_7arara_tahwiya');
            $table->integer('mo3idat_akfass_total');
            $table->integer('mo3idat_akfass_mothers');
            $table->integer('mo3idat_akfass_fathers');
            $table->integer('mo3idat_akfass_tassmin');
            $table->enum('mo3idat_naw3_akfass', ['mostawrad','ma7ali']);
        // tagdiya
            $table->enum('tagdiya_name_3ilaf', ['kharboch','sim','wachfon','other']);
            $table->enum('tagdiya_3ilaf_mada_idafiya', ['yes','no']);
            $table->enum('tagdiya_3ilaf_tarika_chiraa', ['derect','mowazi3_a','mowazi3_b']);
            $table->float('tagdiya_3ilaf_prix');
            $table->enum('tagdiya_3ilaf_massa3ib', ['bo3d_massafa','prix_ghali','kilat_mowazi3in','tadabdob_intaj']);
        // ri3aya
            $table->integer('ri3aya_numbers_bayatira');
            $table->enum('ri3aya_mantojat_saydalaniya', ['yes','no']);
            $table->string('ri3aya_mantojat_saydalaniya_no');
            $table->string('ri3aya_mantojat_saydalaniya_yes');
            $table->enum('ri3aya_talki7', ['koklafaks','parfak','vhd1','vhd2']);
            $table->float('ri3aya_talki7_prix');
            $table->string('ri3aya_adwiya_mosta3mala');
            $table->string('ri3aya_mo3akimat_mosta3mala');
            $table->enum('ri3aya_tamtalik_i3timad_si7i', ['yes','no']);
        // tasswik,
            $table->float('tasswik_motawassit_wazn_bay3_arnab');
            $table->enum('tasswik_kayfiyat_bay3', ['arnab','mizan']);
            $table->float('tasswik_prix_arnab_kg');
            $table->enum('tasswik_ayna_yatim_bay3', ['dakhil_ambar','kharij_ambar']);
            $table->enum('tasswik_morakib_si7i_dab7', ['yes','no']);
            $table->enum('tasswik_barnamaj_dab7', ['monadam','gayr_monadam']);
            $table->enum('tasswik_zabon_raissi', ['wassit','mata3im','souk','mostahlik_daim']);
            $table->string('tasswik_rotab_mostahlikin');
            $table->enum('tasswik_bay3_montadam_nafss_kamiya', ['yes','no']);
            $table->integer('tasswik_numbers_bay3_montadam_nafss_kamiya');
            $table->enum('tasswik_kayfiya_takhzin', ['madbo7','7ay']);
            $table->enum('tasswik_modat_takhzin', ['motawassita','9assira','tawila']);
            $table->enum('tasswik_machakil',['motadabdib', 'takhzin', 'thakafa_istihlak', 'nakl', 'takhar_daf3','dab7']);
            $table->enum('tasswik_ishar_li_mantojk', ['yes','no']);
            $table->string('tasswik_ishar_li_mantojk_how');
            $table->enum('tasswik_ishar_li_mantojk_radat_fi3l', ['lamobalat','ihtimam','lachaya']);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('farmers');
    }
}
