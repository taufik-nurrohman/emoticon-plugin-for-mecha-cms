<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <fieldset>
    <legend><?php echo $speak->plugin_emoticon->title->defines; ?></legend>
    <p><?php echo $speak->plugin_emoticon->description->defines; ?></p>
    <table class="table-bordered table-full-width table-sortable table-emoticon-defines">
      <thead>
        <tr>
          <th><?php echo $speak->plugin_emoticon->title->icon; ?></th>
          <th class="th-icon"><?php echo Jot::info($speak->plugin_emoticon->description->order); ?></th>
          <th><?php echo $speak->plugin_emoticon->title->smiley; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $emoticon_config = File::open(__DIR__ . DS . 'states' . DS . 'config.txt')->unserialize(); ?>
        <?php foreach($emoticon_config['defines'] as $icon => $defines): ?>
        <tr draggable="true">
          <td class="td-icon"><i class="se" data-icon="&#x<?php echo $icon; ?>;"></i></td>
          <td class="handle"></td>
          <td><?php echo Form::text('defines[' . $icon . ']', $defines, null, array('class' => 'input-block')); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
  <fieldset>
    <legend><?php echo $speak->plugin_emoticon->title->scope; ?></legend>
    <p><?php echo $speak->plugin_emoticon->description->scope; ?></p>
    <div class="p">
      <?php

      $scopes = isset($emoticon_config['scopes']) && is_array($emoticon_config['scopes']) ? $emoticon_config['scopes'] : array();
      $scope_fields = array(
          // content
          'article:content' => $speak->plugin_emoticon->title->article->content,
          'page:content' => $speak->plugin_emoticon->title->page->content,
          'comment:message' => $speak->plugin_emoticon->title->comment->content,
          // title
          'article:title' => $speak->plugin_emoticon->title->article->title,
          'page:title' => $speak->plugin_emoticon->title->page->title,
          'comment:name' => $speak->plugin_emoticon->title->comment->title
      );

      ?>
      <?php foreach($scope_fields as $filter => $scope): ?>
      <div><?php echo Form::checkbox('scopes[]', $filter, Mecha::walk($scopes)->has($filter), $scope); ?></div>
      <?php endforeach; ?>
    </div>
  </fieldset>
  <p><?php echo Jot::button('action', $speak->update); ?></p>
</form>