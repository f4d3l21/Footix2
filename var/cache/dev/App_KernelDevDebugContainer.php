<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZeCxUVt\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZeCxUVt/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZeCxUVt.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZeCxUVt\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerZeCxUVt\App_KernelDevDebugContainer([
    'container.build_hash' => 'ZeCxUVt',
    'container.build_id' => '9a9d9d33',
    'container.build_time' => 1668808066,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZeCxUVt');
