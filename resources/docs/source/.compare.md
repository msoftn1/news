---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## Главная страница.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_1ec6d873aff5bcbcd253edbebf69b483 -->
## Картинка.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET image/{name}`


<!-- END_1ec6d873aff5bcbcd253edbebf69b483 -->

<!-- START_afe861116942da8827f905c42d93c7cd -->
## Источники.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/sources" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/sources"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET sources`


<!-- END_afe861116942da8827f905c42d93c7cd -->

<!-- START_ee7d181eea5cc08abaa69c24360ab736 -->
## Источник по идентификатору.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/source/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/source/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET source/{id}`


<!-- END_ee7d181eea5cc08abaa69c24360ab736 -->

<!-- START_75f42ec433e133f15390cda3741b4b3a -->
## Авторы.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/authors" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/authors"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET authors`


<!-- END_75f42ec433e133f15390cda3741b4b3a -->

<!-- START_560ac4846cdf6b6d5159ded7464bb180 -->
## Автор по идентификатору.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/author/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/author/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET author/{id}`


<!-- END_560ac4846cdf6b6d5159ded7464bb180 -->

<!-- START_08cdbfca8f863c7bf0b48ea44b983bc4 -->
## Страница новости.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET view/{id}`


<!-- END_08cdbfca8f863c7bf0b48ea44b983bc4 -->

<!-- START_5a4a799041a59b3d2b1fe319c96765b0 -->
## Поиск новостей по датам.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/search/date/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/search/date/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET search/date/{dateStart}/{dateEnd}`


<!-- END_5a4a799041a59b3d2b1fe319c96765b0 -->

<!-- START_4a6f52f94911b75da445847a99c7129a -->
## Язык.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/language/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/language/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET language/{language}`


<!-- END_4a6f52f94911b75da445847a99c7129a -->

<!-- START_62e83267ed545595ab00327f3be136f3 -->
## Категория.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET category/{category}`


<!-- END_62e83267ed545595ab00327f3be136f3 -->

<!-- START_263b06c9c13c904827fae32129b4851f -->
## AJAX поиск.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/search/ajax" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/search/ajax"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    "EU leaders seek to ramp up pressure on Belarus president",
    "Iran surpasses 20,000 confirmed deaths from the coronavirus",
    "Police declare riot in Portland amid ongoing protests",
    "Senate Republicans preparing $500B virus relief proposal",
    "As states threaten lawsuits, postmaster general suspends mail-handling changes until after election",
    "Senate report details Russia’s efforts to meddle in 2016, ties to Trump associates",
    "Feds attempting to seize home of former pro wrestler",
    "Former DHS official now backing Biden warns Trump others will speak out",
    "Trump's 'rigged' election claim is 'an attack on America': Pete Buttigieg",
    "Floridians voting by mail in huge numbers compared to 2016"
]
```

### HTTP Request
`GET search/ajax`


<!-- END_263b06c9c13c904827fae32129b4851f -->

<!-- START_c0f505b72e10817948e65eb5eb744708 -->
## Поиск.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET search`


<!-- END_c0f505b72e10817948e65eb5eb744708 -->

<!-- START_c02dc2b26ceac78a3f4c9f538711f9fd -->
## Источники.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/sources" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/sources"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/sources`


<!-- END_c02dc2b26ceac78a3f4c9f538711f9fd -->

<!-- START_7eed41331431b9b910cfaf6ffe765e93 -->
## Новости по источнику.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/newsBySource" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/newsBySource"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/newsBySource`


<!-- END_7eed41331431b9b910cfaf6ffe765e93 -->

<!-- START_3772937dbe5b8563b135eaf8dd2f6b6a -->
## Новости по языку.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/newsByLanguage" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/newsByLanguage"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/newsByLanguage`


<!-- END_3772937dbe5b8563b135eaf8dd2f6b6a -->

<!-- START_f3cce955ef23c77aa66e1f41f53e5c43 -->
## Новости по категории.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/newsByCategory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/newsByCategory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/newsByCategory`


<!-- END_f3cce955ef23c77aa66e1f41f53e5c43 -->

<!-- START_79bc7615841a913da091a3301aae3827 -->
## Новости по стране.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/newsByCountry" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/newsByCountry"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/newsByCountry`


<!-- END_79bc7615841a913da091a3301aae3827 -->

<!-- START_3bab43dfe271fb0e38279405e0007ddb -->
## Поиск новостей.

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/newsSearch" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/newsSearch"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
null
```

### HTTP Request
`GET api/newsSearch`


<!-- END_3bab43dfe271fb0e38279405e0007ddb -->


