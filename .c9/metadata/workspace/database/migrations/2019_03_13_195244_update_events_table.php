{"filter":false,"title":"2019_03_13_195244_update_events_table.php","tooltip":"/database/migrations/2019_03_13_195244_update_events_table.php","undoManager":{"mark":11,"position":11,"stack":[[{"start":{"row":16,"column":13},"end":{"row":16,"column":14},"action":"remove","lines":["/"],"id":9},{"start":{"row":16,"column":12},"end":{"row":16,"column":13},"action":"remove","lines":["/"]}],[{"start":{"row":16,"column":12},"end":{"row":22,"column":33},"action":"insert","lines":["$table->increments('id');","            $table->varchar('event_name');","            $table->datetime('start_date');","            $table->datetime('end_date');","            $table->boolean('all_day');","            $table->string('color');","            $table->timestamps();"],"id":10}],[{"start":{"row":17,"column":20},"end":{"row":17,"column":27},"action":"remove","lines":["varchar"],"id":11},{"start":{"row":17,"column":20},"end":{"row":17,"column":21},"action":"insert","lines":["s"]}],[{"start":{"row":17,"column":20},"end":{"row":17,"column":21},"action":"remove","lines":["s"],"id":12},{"start":{"row":17,"column":20},"end":{"row":17,"column":26},"action":"insert","lines":["string"]}],[{"start":{"row":14,"column":5},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":22},{"start":{"row":15,"column":0},"end":{"row":15,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":15,"column":8},"end":{"row":15,"column":29},"action":"insert","lines":["Schema::drop('users')"],"id":23}],[{"start":{"row":15,"column":29},"end":{"row":15,"column":30},"action":"insert","lines":[";"],"id":24}],[{"start":{"row":15,"column":22},"end":{"row":15,"column":27},"action":"remove","lines":["users"],"id":25},{"start":{"row":15,"column":22},"end":{"row":15,"column":23},"action":"insert","lines":["e"]},{"start":{"row":15,"column":23},"end":{"row":15,"column":24},"action":"insert","lines":["v"]},{"start":{"row":15,"column":24},"end":{"row":15,"column":25},"action":"insert","lines":["e"]}],[{"start":{"row":15,"column":22},"end":{"row":15,"column":25},"action":"remove","lines":["eve"],"id":26},{"start":{"row":15,"column":22},"end":{"row":15,"column":28},"action":"insert","lines":["events"]}],[{"start":{"row":15,"column":31},"end":{"row":24,"column":11},"action":"remove","lines":["","        Schema::table('events', function (Blueprint $table) {","            $table->increments('id');","            $table->string('event_name');","            $table->datetime('start_date');","            $table->datetime('end_date');","            $table->boolean('all_day');","            $table->string('color');","            $table->timestamps();","        });"],"id":27}],[{"start":{"row":15,"column":8},"end":{"row":15,"column":31},"action":"remove","lines":["Schema::drop('events');"],"id":28},{"start":{"row":15,"column":8},"end":{"row":24,"column":11},"action":"insert","lines":["","        Schema::table('events', function (Blueprint $table) {","            $table->increments('id');","            $table->string('event_name');","            $table->datetime('start_date');","            $table->datetime('end_date');","            $table->boolean('all_day');","            $table->string('color');","            $table->timestamps();","        });"]}],[{"start":{"row":15,"column":4},"end":{"row":15,"column":8},"action":"remove","lines":["    "],"id":29},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"remove","lines":["    "]},{"start":{"row":14,"column":5},"end":{"row":15,"column":0},"action":"remove","lines":["",""]}]]},"ace":{"folds":[],"scrolltop":60,"scrollleft":0,"selection":{"start":{"row":9,"column":26},"end":{"row":9,"column":26},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":3,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1552507692023,"hash":"6829931700401de5a69ba29d7381aec8b4959727"}