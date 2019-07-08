## Using ElasticSearch query builder

$text = 'UFOs over China';

$hosts = [
    'localhost',
];
$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

$qb = new \Gesof\ElasticSearch\QueryBuilder($client);

$qb
    ->setTable('posts')
    ->orderBy('_id', 'desc')
;

$andX = $qb->expr()->andX();
$andX->add($qb->expr()->eq('is_completed', TRUE));
$andX->add($qb->expr()->gt('view_count', 10));

$orX = $qb->expr()->orX();
$orX->add($qb->expr()->matchText('title', $text));
$orX->add($qb->expr()->matchText('description', $text));

$andX->add($orX);

$qb->where($andX);
$qb
    ->setMaxResults(10)
    ->setFirstResult(0)
;

$resultCount = $qb->getQuery()->count()->getCount();
$documents = $qb->getQuery()->search()->getDocuments();