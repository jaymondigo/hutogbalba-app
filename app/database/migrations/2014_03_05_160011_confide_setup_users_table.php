<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('type', array('admin','dreamer','vendor', 'engineer','architect'));
            $table->enum('gender', array('male','female','other'));
            $table->date('birth_date');
            $table->text('bio');
            $table->dateTime('last_signin');
            $table->enum('online_status', array('online','busy','offline','away'));
            $table->string('password');
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function($t)
        {
            $t->string('email');
            $t->string('token');
            $t->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::drop('users');
    }

}
