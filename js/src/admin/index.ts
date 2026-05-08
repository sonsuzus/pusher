import app from 'flarum/admin/app';

app.initializers.add('flarum-pusher', () => {
  app.extensionData
    .for('flarum-pusher')
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
    )
    // BURADAN İTİBAREN YENİ EKLENENLER:
    .registerSetting({
        setting: 'flarum-pusher.app_host',
        label: 'Host (örn: 127.0.0.1 veya soketi.site.com)',
        type: 'text',
    })
    .registerSetting({
        setting: 'flarum-pusher.app_port',
        label: 'Port (örn: 6001)',
        type: 'number',
    })
    .registerSetting({
        setting: 'flarum-pusher.app_scheme',
        label: 'Scheme (http veya https)',
        type: 'text',
    });
});
