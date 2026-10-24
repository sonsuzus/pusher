import app from 'flarum/admin/app';

app.initializers.add('sonsuzus-pusher', () => {
  app.registry // Flarum 2.0'da extensionData yerine registry kullanılıyor
    .for('sonsuzus-pusher')
    .registerSetting(
      {
        setting: 'flarum-pusher.server_hostname',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.server_hostname_label'),
        help: app.translator.trans('flarum-pusher.admin.pusher_settings.server_hostname_help'),
        type: 'text',
        placeholder: 'soketi.example.com',
      },
      50
    )
    .registerSetting(
      {
        setting: 'flarum-pusher.server_port',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.server_port_label'),
        help: app.translator.trans('flarum-pusher.admin.pusher_settings.server_port_help'),
        type: 'number',
        placeholder: '443',
      },
      40
    )
    .registerSetting(
      {
        setting: 'flarum-pusher.app_id',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.app_id_label'),
        type: 'text',
      },
      30
    )
    .registerSetting(
      {
        setting: 'flarum-pusher.app_key',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.app_key_label'),
        type: 'text',
      },
      20
    )
    .registerSetting(
      {
        setting: 'flarum-pusher.app_secret',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.app_secret_label'),
        type: 'text',
      },
      10
    )
    .registerSetting(
      {
        setting: 'flarum-pusher.app_cluster',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.app_cluster_label'),
        type: 'text',
      },
      0
    );
});