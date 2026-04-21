<?php

declare(strict_types=1);

/**
 * ============================================
 * 1. SINGLE RESPONSIBILITY PRINCIPLE (SRP)
 * ============================================
 */

// ❌ Bad: One class does multiple responsibilities
class UserPage
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function showUsers(): void
    {
        // Database logic
        $stmt = $this->db->query("SELECT id, name, email FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // HTML rendering
        echo "<h1>Users</h1><ul>";
        foreach ($users as $u) {
            echo "<li>{$u['name']} ({$u['email']})</li>";
        }
        echo "</ul>";
    }
}

// ✅ Good: Separate responsibilities
class UserRepository
{
    public function __construct(private PDO $db) {}

    public function all(): array
    {
        $stmt = $this->db->query("SELECT id, name, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class UserListView
{
    public function render(array $users): string
    {
        $html = "<h1>Users</h1><ul>";
        foreach ($users as $u) {
            $name = htmlspecialchars($u['name']);
            $email = htmlspecialchars($u['email']);
            $html .= "<li>{$name} ({$email})</li>";
        }
        $html .= "</ul>";
        return $html;
    }
}


/**
 * ============================================
 * 2. AVOID GOD CLASS
 * ============================================
 */

// ❌ Bad: God Class
class System
{
    public function login(string $email, string $password): bool
    {
        return true;
    }

    public function createProduct(array $data): int
    {
        return 1;
    }

    public function renderTemplate(string $template, array $vars): string
    {
        return "";
    }

    public function sendEmail(string $to, string $subject, string $body): void {}
}

// ✅ Good: Split into smaller classes
class AuthService
{
    public function login(string $email, string $password): bool
    {
        return true;
    }
}

class ProductRepository
{
    public function insert(string $name, int $price): int
    {
        return rand(1, 1000);
    }
}

class ProductService
{
    public function __construct(private ProductRepository $repo) {}

    public function createProduct(string $name, int $price): int
    {
        return $this->repo->insert($name, $price);
    }
}

class TemplateRenderer
{
    public function render(string $template, array $vars = []): string
    {
        return "<p>Rendered template</p>";
    }
}


/**
 * ============================================
 * 3. TYPE HINTING
 * ============================================
 */

class Person
{
    private int $age = 0;

    public function setAge(int $age): void
    {
        if ($age < 0) {
            throw new InvalidArgumentException("Age must be >= 0");
        }
        $this->age = $age;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function isAdult(): bool
    {
        return $this->age >= 18;
    }
}


/**
 * ============================================
 * 4. NAMING CONVENTIONS
 * ============================================
 */

// ✅ Good naming
class ProductController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showProductList(): string
    {
        $products = [1, 2, 3]; // demo data
        return "Total products: " . count($products);
    }
}

// ❌ Bad naming examples (commented to avoid errors)
/*
class product_controller {}
public function ShowProductList() {}
private $ProductRepository;
*/


/**
 * ============================================
 * DEMO RUN (OPTIONAL)
 * ============================================
 */

echo "<h2>OOP Best Practices Demo</h2>";
// SRP demo WITHOUT database (fake data)
$users = [
    ["name" => "Alice", "email" => "alice@gmail.com"],
    ["name" => "Bob", "email" => "bob@gmail.com"]
];

$view = new UserListView();
echo $view->render($users);

// Type Hinting demo
$person = new Person();
$person->setAge(20);
echo "<p>Age: " . $person->getAge() . "</p>";
echo "<p>Is Adult: " . ($person->isAdult() ? "Yes" : "No") . "</p>";

// Naming demo
$productRepo = new ProductRepository();
$productController = new ProductController($productRepo);
echo "<p>" . $productController->showProductList() . "</p>";
// SRP demo WITHOUT database (fake data)
$users = [
    ["name" => "Alice", "email" => "alice@gmail.com"],
    ["name" => "Bob", "email" => "bob@gmail.com"]
];

$view = new UserListView();
echo $view->render($users);

// SRP demo (NOTE: requires real DB to run)
// Uncomment if you have PDO setup
/*
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$repo = new UserRepository($pdo);
$view = new UserListView();
echo $view->render($repo->all());
*/

?>