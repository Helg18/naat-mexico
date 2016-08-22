<?phpDropColumn

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->boolean('is_active');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->DropColumn('is_active');        
        });
    }
}
