// change staticCache name on assets change
const staticCache = 'campmate-v1'

const assets = [
 './assets/offline.php'
]

self.addEventListener('install', evt => {
 // install serviceworker
 evt.waitUntil(
  caches.open(staticCache).then(cache => {
   cache.addAll(assets)
  })
 )
})


self.addEventListener('activate', evt => {
 // activate service worker
 evt.waitUntil(
  caches.keys().then(keys => {
   return Promise.all(keys
   .filter(key => key !== staticCache)
   .map(key => caches.delete(key))
   )
  })
 )
})

self.addEventListener('fetch', evt => {
 // cache files/assets
 evt.respondWith(
  fetch(evt.request).then(res => {
   return res
  }).catch(() => caches.match('./assets/offline.php'))
 )
})