 {extends file='page.tpl'} 


{block name='page_content'} 

<form id="formFAQ" action="." method="post" >
  <label for="input_name">Your names</label>
  <input type="text" name="name_input" id="input_name">
  <label for="input_email">Your enmail</label>
  <input type="text" name="email_input" id="input_email">
  <label for="input_question">Your question</label>
  <textarea name="question_input" id="input_question"></textarea>
  <button type="submit">Send your question</button>
</form>


{/block} 
