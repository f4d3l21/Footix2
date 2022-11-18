<?php

namespace ContainerZeCxUVt;
include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/src/Persistence/ObjectManager.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder1ff8a = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerd8e84 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties3b0f5 = [
        
    ];

    public function getConnection()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getConnection', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getMetadataFactory', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getExpressionBuilder', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'beginTransaction', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->beginTransaction();
    }

    public function getCache()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getCache', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getCache();
    }

    public function transactional($func)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'transactional', array('func' => $func), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'wrapInTransaction', array('func' => $func), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'commit', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->commit();
    }

    public function rollback()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'rollback', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getClassMetadata', array('className' => $className), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'createQuery', array('dql' => $dql), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'createNamedQuery', array('name' => $name), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'createQueryBuilder', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'flush', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'clear', array('entityName' => $entityName), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->clear($entityName);
    }

    public function close()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'close', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->close();
    }

    public function persist($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'persist', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'remove', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'refresh', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'detach', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'merge', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getRepository', array('entityName' => $entityName), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'contains', array('entity' => $entity), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getEventManager', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getConfiguration', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'isOpen', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getUnitOfWork', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getProxyFactory', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'initializeObject', array('obj' => $obj), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'getFilters', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'isFiltersStateClean', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'hasFilters', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return $this->valueHolder1ff8a->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializerd8e84 = $initializer;

        return $instance;
    }

    public function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config)
    {
        static $reflection;

        if (! $this->valueHolder1ff8a) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder1ff8a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder1ff8a->__construct($conn, $config);
    }

    public function & __get($name)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__get', ['name' => $name], $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        if (isset(self::$publicProperties3b0f5[$name])) {
            return $this->valueHolder1ff8a->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1ff8a;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder1ff8a;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1ff8a;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder1ff8a;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__isset', array('name' => $name), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1ff8a;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder1ff8a;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__unset', array('name' => $name), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1ff8a;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder1ff8a;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__clone', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        $this->valueHolder1ff8a = clone $this->valueHolder1ff8a;
    }

    public function __sleep()
    {
        $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, '__sleep', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;

        return array('valueHolder1ff8a');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializerd8e84 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializerd8e84;
    }

    public function initializeProxy() : bool
    {
        return $this->initializerd8e84 && ($this->initializerd8e84->__invoke($valueHolder1ff8a, $this, 'initializeProxy', array(), $this->initializerd8e84) || 1) && $this->valueHolder1ff8a = $valueHolder1ff8a;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder1ff8a;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder1ff8a;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
