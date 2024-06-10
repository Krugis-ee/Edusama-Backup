<table>
<thead>
  <tr>
    <th>ID</th>
    <th>Title</th>
	<th>Teacher</th>
	<th>Subject</th>
	<th>Delivery Date</th>	
	<th>PDF</th>
	<th>Class Room</th>
	<th>Publish Status</th>
	<th>Publish Date</th>
  </tr>
</thead>
<tbody>
@foreach ($assignments as $assignment)
    <tr>
       <td >{{ $assignment->id }}</td>
       <td >{{ $assignment->title }}</td>
	   <td><?php 
					  $teacher_id=$assignment->teacher_id; 
					  $teacher=App\Models\User::find($teacher_id);
					  echo $teacher->first_name.' '.$teacher->last_name;
					  ?></td>
	<td><?php 
					  $subject_id=$assignment->subject_id; 
					  $subject=App\Models\Subject::find($subject_id);
					  echo $subject->subject_name;
					  ?></td>
<td>{{ $assignment->delivery_date }}		</td>
         
<td>{{ asset('assignments/'.$assignment->assignment_pdf) }}</td>
<td><?php 
					  $class_room_id=$assignment->class_room_id; 
					  $room=App\Models\ClassRooms::find($class_room_id);
					  echo $room->class_room_name;
					  ?></td>	
<td >{{ $assignment->publish_status }}</td>
<td >{{ $assignment->publish_date }}</td>					  
    </tr>
@endforeach
</tbody>
</table>