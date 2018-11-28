 {extends file="page.tpl"} 


{block name="page_content"} 
<section class="FAQ Area"> 
<h2> Welcome to FAQ area !! </h2>
</section>



<section class="sec_formFAQ">
<h3>Ask your question</h3>
// l action du form doit etre vide pour renvoyer sur la meme page
<form id="formFAQ" action="" method="post" >
  <label for="input_question">Your question:</label>
  <textarea name="question_input" id="input_question"></textarea>
  <button name="btnAddquestion" type="submit">Send your question</button>
</form>

</section>
{/block} 
