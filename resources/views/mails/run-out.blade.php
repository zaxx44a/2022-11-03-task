
Hi There,

We Should Inform you that <b>{{ $ingredient->name }}</b> is less that threshold ({{ $ingredient->threshold }}%) :<br/>

Current : {{ $ingredient->current }} {{ $ingredient->unit }}<br/>
Full Load : {{ $ingredient->full_load }} {{ $ingredient->unit }}<br/>
Threshold : {{ $ingredient->full_load * ($ingredient->threshold/ 100) }} {{ $ingredient->unit }}<br/>