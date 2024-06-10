<table>
<thead>
  <tr>
    <th>ID</th>
    <th>Title</th>
	<th>Student</th>
	<th>Subject</th>
	<th>Submitted On</th>	
	<th>Answer PDF</th>
	<th>Score</th>
	<th>Score Comments</th>
  </tr>
</thead>
<tbody>
@foreach ($assignment_progresses as $assignment_progress)
    <tr>
       <td >{{ $assignment_progress->id }}</td>
       <td ><?php 
					  $assignment_id=$assignment_progress->assignment_id; 
					  $assignment_obj=App\Models\Assignment::find($assignment_id);
					  echo $assignment_obj->title;
					  ?></td>
	   <td><?php 
					  $student_id=$assignment_progress->student_id; 
					  $student=App\Models\User::find($student_id);
					  echo $student->first_name.' '.$student->last_name;
					  ?></td>
	<td><?php 
					  $subject_id=$assignment_obj->subject_id; 
					  $subject=App\Models\Subject::find($subject_id);
					  echo $subject->subject_name;
					  ?></td>
<td><?php
					  $originalDate = $assignment_obj->created_at;
					 echo $submitted_on = date("d-m-Y", strtotime($originalDate));?>
		</td>
         
<td>{{ asset('pdf/student_assignment/answer_file/'.$assignment_progress->answer_pdf) }}</td>		 
    <td ><?php echo $assignment_progress->score; ?></td>
	<td ><?php echo $assignment_progress->score_comment; ?></td>
	</tr>
@endforeach
</tbody>
</table>