


<!-- Block faqModule -->
<div id="faqModule_block_home" class="block">
  <div class="block_content">
  <p>Hello,
       {if isset($my_module_name) && $my_module_name}
           {$my_module_name}
       {else}
           World
       {/if}
       !
    </p>
    <ul>
     <li><a href="{$faqModule_link}" title="Click this link">Click me for FAQ !</a></li>
    </ul>
  </div>
</div>
<!-- /Block faqModule -->