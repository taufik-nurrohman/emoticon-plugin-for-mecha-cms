<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <fieldset>
    <legend><?php echo $speak->plugin_emoticon_title_defines; ?></legend>
    <p><?php echo $speak->plugin_emoticon_description_defines; ?></p>
    <table class="table-bordered table-full-width table-sortable table-emoticon-defines">
      <thead>
        <tr>
          <th><?php echo $speak->plugin_emoticon_title_icon; ?></th>
          <th class="th-icon"><?php echo $speak->plugin_emoticon_title_order; ?></th>
          <th><?php echo $speak->plugin_emoticon_title_smiley; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $emoticon_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize(); ?>
        <?php foreach($emoticon_config['defines'] as $icon => $defines): ?>
        <tr draggable="true">
          <td class="td-icon"><span class="se"><?php echo '&#x' . $icon . ';'; ?></span></td>
          <td class="handle"></td>
          <td><?php echo Form::text('defines[' . $icon . ']', $defines, null, array('class' => 'input-block')); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
  <fieldset>
    <legend><?php echo $speak->plugin_emoticon_title_scope; ?></legend>
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
      <div><?php echo Form::checkbox('scopes[]', $filter, in_array($filter, $scopes), $scope); ?></div>
      <?php endforeach; ?>
    </div>
  </fieldset>
  <p><?php echo Jot::button('action', $speak->update); ?></p>
</form>