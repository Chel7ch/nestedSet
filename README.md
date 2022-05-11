Laravel package for working with trees in databases.

Theory: https://webscript.ru/stories/04/09/01/8197045

### Using

Each node has 3 unique indexes: id , lk and rk.
To start manipulating the nodes of the tree, we learn 
the attributes of the node:
$prop=array('id'=>5, 'lk'=>3, 'rk'=>8);  
or any part of: 
$prop=array('lk'=>3);

$node=(new Node)->prepare($prop);

### Select
#### the entire branch in which our node participates:
```php
$tree = new Categories();
$tree->getEntireBranch($node);
```
#### ancestors of node:
```php
$tree->getAncestors($node);
```
#### ancestors of the node and node together:
```php
$tree->getAncestorNode($node);
```
#### Node's descendants:
```php
$tree->getDescendant($node);
```
#### the descendants with a node:
```php
$tree->getDescendantNode($node);
```
#### all tree:
```php
$tree->getTree();
```
etc.
### Add node
#### a child node:
```php
$tree->createNode($parantNode, $nodeName);
```
#### rename a node:
```php
$tree->renameNode($node, $newName)
```
#### delete a node with descendants:
```php
$tree->deleteNode($node);
```
#### clear everything:
```php
$tree->();
```
## move a node:
```php
$tree->moveNode($node, $newParent)
```
#### check the integrity of the tree:
```php
$check= new CheckOfTree(new Categories);
$check->inspect();
```
