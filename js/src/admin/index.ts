import app from 'flarum/admin/app';

// Başlatıcı adını 'sonsuzus-pusher' olarak güncellemek çakışmaları önler
app.initializers.add('sonsuzus-pusher', () => {
  app.extensionData
    // KRİTİK DÜZELTME: 'flarum-pusher' yerine 'sonsuzus-pusher' olmalı.
    // composer.json'daki "sonsuzus/pusher" ismine karşılık gelir.
    .for('sonsuzus-pusher') 
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
    .registerSetting({
        setting: 'flarum-pusher.app_host',
        label: app.translator.trans('flarum-pusher.admin.pusher_settings.app_host_label'),
        type: 'text',
    },
     -10
    )
    .registerSetting({
        setting: 'flarum-pusher.app_port',
        label: 'Port (örn: 6001)',
        type: 'number',
    },
     -20
    )
    .registerSetting({
        setting: 'flarum-pusher.app_scheme',
        label: 'Scheme (http veya https)',
        type: 'text',
    },
     -30
    );
});
