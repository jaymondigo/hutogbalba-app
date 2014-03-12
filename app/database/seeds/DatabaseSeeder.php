<?php
    class DatabaseSeeder extends Seeder {

        public function run()
        {
            
            // $this->call('UserTableSeeder');
            // $this->command->info('User table seeded!');
            
            $this->call('ElementTableSeeder');
            $this->command->info('Element table seeded!');

             $this->call('TypeTableSeeder');
            $this->command->info('Material Type table seeded!');
        }

    }
    class ElementTableSeeder extends Seeder{
    	public function run(){
    		$table = DB::table('elements');
            $table->delete(); 
            $table->insert(array(
            		array('name'=>'basic'),
            		array('name'=>'roof'),
            		array('name'=>'wall'),
            		array('name'=>'floor'),
            	));
    	}
    }   
    class TypeTableSeeder extends Seeder{
    	public function run(){
    		$table = DB::table('types');
            $table->delete(); 
            $table->insert(array(
            		array('id'=>0,'name'=>'Steel Bars', 'element'=>0),
            		array('id'=>2,'name'=>'Gravel', 'element'=>0),
            		array('id'=>3,'name'=>'Nails', 'element'=>0),
            		array('id'=>4,'name'=>'asphal shingles ', 'element'=>1),
            		array('id'=>5,'name'=>'Clay Tiles', 'element'=>1),
            		array('id'=>6,'name'=>'Wood Shakes', 'element'=>1),
            		array('id'=>7,'name'=>'horizontal sliding wall', 'element'=>2),
            		array('id'=>8,'name'=>'Masonry wall', 'element'=>2),
            		array('id'=>9,'name'=>'Stone wall', 'element'=>2),
            		array('id'=>10,'name'=>'Plywood wall', 'element'=>2),
            		array('id'=>11,'name'=>'Wood Framed', 'element'=>2),
            		array('id'=>12,'name'=>'Steel Framed', 'element'=>2),
            		array('id'=>13,'name'=>'51mmx51mm', 'element'=>3),
            		array('id'=>14,'name'=>'102mmx102mm', 'element'=>3),
            		array('id'=>15,'name'=>'204mmx204mm', 'element'=>3),
            		array('id'=>16,'name'=>'254mmx254mm', 'element'=>3),
            		array('id'=>17,'name'=>'305mmx305mm', 'element'=>3),
            		array('id'=>18,'name'=>'331mmx331mm', 'element'=>3),
            		array('id'=>19,'name'=>'407mmx407mm', 'element'=>3),
            		array('id'=>20,'name'=>'Hardwood Floor', 'element'=>3),
            		array('id'=>21,'name'=>'Laminate Floor', 'element'=>3),
            		array('id'=>22,'name'=>'Parquet Floor', 'element'=>3),
            		array('id'=>23,'name'=>'Sand', 'element'=>0),
            	)); 
    	}
    }

?>
  