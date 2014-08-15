<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <input name="token" type="hidden" value="<?php echo $token; ?>">
  <fieldset>
    <legend><?php echo $speak->plugin_emoticon_title_defines; ?></legend>
    <p><?php echo $speak->plugin_emoticon_description_defines; ?></p>
    <table class="table-bordered table-full table-sortable table-emoticon-defines">
      <colgroup>
        <col style="width:8em;">
        <col style="width:2.8em;">
        <col>
      </colgroup>
      <thead>
        <tr>
          <th><?php echo $speak->plugin_emoticon_title_symbol; ?></th>
          <th class="text-center"><?php echo $speak->plugin_emoticon_title_order; ?></th>
          <th><?php echo $speak->plugin_emoticon_title_smiley; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $emoticon_config = File::open(PLUGIN . DS . 'emoticon-1' . DS . 'states' . DS . 'config.txt')->unserialize(); ?>
        <?php foreach($emoticon_config['defines'] as $icon => $defines): ?>
        <tr>
          <td class="align-middle"><i class="se-i se-i-<?php echo $icon; ?>"></i></td>
          <td class="text-center align-middle">
            <a class="sort" href="#move-up" title="<?php echo $speak->plugin_emoticon_title_order_move_up; ?>"><i class="fa fa-angle-up"></i></a><a class="sort" href="#move-down" title="<?php echo $speak->plugin_emoticon_title_order_move_down; ?>"><i class="fa fa-angle-down"></i></a>
          </td>
          <td><input name="defines[<?php echo $icon; ?>]" type="text" class="input-block" value="<?php echo Text::parse($defines)->to_encoded_html; ?>"></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
  <fieldset>
    <legend><?php echo $speak->scope; ?></legend>
    <p><?php echo $speak->plugin_emoticon_description_scope; ?></p>
    <div class="p">
      <?php

      $scopes = isset($emoticon_config['scopes']) && is_array($emoticon_config['scopes']) ? $emoticon_config['scopes'] : array();
      $scope_fields = array(
          'article:content' => $speak->article,
          'page:content' => $speak->page,
          'article:title' => $speak->plugin_emoticon_title_article_title,
          'page:title' => $speak->plugin_emoticon_title_page_title,
          'comment:message' => $speak->comment
      );

      ?>
      <?php foreach($scope_fields as $filter => $scope): ?>
      <div><label><input name="scopes[]" value="<?php echo $filter; ?>" type="checkbox"<?php echo in_array($filter, $scopes) ? ' checked' : ""; ?>> <span><?php echo $scope; ?></span></label></div>
      <?php endforeach; ?>
    </div>
  </fieldset>
  <p>
    <button class="btn btn-action" type="submit"><i class="fa fa-check-circle"></i> <?php echo $speak->update; ?></button>
  </p>
</form>