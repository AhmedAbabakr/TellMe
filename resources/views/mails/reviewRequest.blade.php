<p style="text-transform: capitalize;">Hello {{$data['customer_name']}},</p> 
<p>Thank you for last review on branch {{$data['branch_name']}} for company  {{$data['company_name_en']}}</p>
<p>because we care about you ,</p>
<p>kindly you can review branch <a href="{{route('review.guest',encrypt($data['review_id']))}}">Here</a></p>
<p>{{$data['company_name_en']}} Team .</p>