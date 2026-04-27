-- Hapus data lama
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE products;
TRUNCATE TABLE categories;
SET FOREIGN_KEY_CHECKS = 1;

-- Insert Categories
INSERT INTO categories (name, created_at, updated_at) VALUES
('Kaos', NOW(), NOW()),
('Hoodie', NOW(), NOW()),
('Celana', NOW(), NOW()),
('Jaket', NOW(), NOW()),
('Aksesoris', NOW(), NOW());

-- Insert Products dengan gambar dari placeholder
INSERT INTO products (name, sku, price, stock, category_id, image, created_at, updated_at) VALUES
-- KAOS (Category ID: 1)
('Kaos Polos Hitam Premium', 'KAOS-001', 85000, 50, 1, 'products/kaos-hitam.jpg', NOW(), NOW()),
('Kaos Polos Putih Premium', 'KAOS-002', 85000, 45, 1, 'products/kaos-putih.jpg', NOW(), NOW()),
('Kaos Polos Navy Premium', 'KAOS-003', 85000, 40, 1, 'products/kaos-navy.jpg', NOW(), NOW()),
('Kaos Grafis Street Art', 'KAOS-004', 125000, 30, 1, 'products/kaos-grafis-1.jpg', NOW(), NOW()),
('Kaos Grafis Vintage', 'KAOS-005', 125000, 25, 1, 'products/kaos-grafis-2.jpg', NOW(), NOW()),
('Kaos Band Edition', 'KAOS-006', 135000, 20, 1, 'products/kaos-band.jpg', NOW(), NOW()),
('Kaos Oversize Hitam', 'KAOS-007', 95000, 35, 1, 'products/kaos-oversize-hitam.jpg', NOW(), NOW()),
('Kaos Oversize Putih', 'KAOS-008', 95000, 30, 1, 'products/kaos-oversize-putih.jpg', NOW(), NOW()),

-- HOODIE (Category ID: 2)
('Hoodie Oversize Abu', 'HOOD-001', 175000, 30, 2, 'products/hoodie-abu.jpg', NOW(), NOW()),
('Hoodie Oversize Hitam', 'HOOD-002', 175000, 35, 2, 'products/hoodie-hitam.jpg', NOW(), NOW()),
('Hoodie Oversize Navy', 'HOOD-003', 175000, 25, 2, 'products/hoodie-navy.jpg', NOW(), NOW()),
('Hoodie Zipper Hitam', 'HOOD-004', 195000, 20, 2, 'products/hoodie-zipper-hitam.jpg', NOW(), NOW()),
('Hoodie Zipper Abu', 'HOOD-005', 195000, 18, 2, 'products/hoodie-zipper-abu.jpg', NOW(), NOW()),
('Hoodie Graphic Design', 'HOOD-006', 210000, 15, 2, 'products/hoodie-graphic.jpg', NOW(), NOW()),

-- CELANA (Category ID: 3)
('Celana Chino Cream', 'CEL-001', 165000, 25, 3, 'products/celana-chino-cream.jpg', NOW(), NOW()),
('Celana Chino Hitam', 'CEL-002', 165000, 30, 3, 'products/celana-chino-hitam.jpg', NOW(), NOW()),
('Celana Chino Navy', 'CEL-003', 165000, 28, 3, 'products/celana-chino-navy.jpg', NOW(), NOW()),
('Celana Cargo Hitam', 'CEL-004', 185000, 22, 3, 'products/celana-cargo-hitam.jpg', NOW(), NOW()),
('Celana Cargo Olive', 'CEL-005', 185000, 20, 3, 'products/celana-cargo-olive.jpg', NOW(), NOW()),
('Celana Jeans Slim Fit', 'CEL-006', 195000, 18, 3, 'products/celana-jeans-slim.jpg', NOW(), NOW()),
('Celana Jeans Regular', 'CEL-007', 185000, 25, 3, 'products/celana-jeans-regular.jpg', NOW(), NOW()),
('Celana Jogger Abu', 'CEL-008', 145000, 30, 3, 'products/celana-jogger-abu.jpg', NOW(), NOW()),

-- JAKET (Category ID: 4)
('Jaket Denim Blue', 'JAK-001', 245000, 15, 4, 'products/jaket-denim-blue.jpg', NOW(), NOW()),
('Jaket Denim Black', 'JAK-002', 245000, 12, 4, 'products/jaket-denim-black.jpg', NOW(), NOW()),
('Jaket Bomber Hitam', 'JAK-003', 225000, 18, 4, 'products/jaket-bomber-hitam.jpg', NOW(), NOW()),
('Jaket Bomber Navy', 'JAK-004', 225000, 15, 4, 'products/jaket-bomber-navy.jpg', NOW(), NOW()),
('Jaket Varsity Hitam', 'JAK-005', 265000, 10, 4, 'products/jaket-varsity.jpg', NOW(), NOW()),
('Jaket Parka Olive', 'JAK-006', 285000, 8, 4, 'products/jaket-parka.jpg', NOW(), NOW()),

-- AKSESORIS (Category ID: 5)
('Topi Snapback Hitam', 'AKS-001', 75000, 40, 5, 'products/topi-snapback-hitam.jpg', NOW(), NOW()),
('Topi Snapback Navy', 'AKS-002', 75000, 35, 5, 'products/topi-snapback-navy.jpg', NOW(), NOW()),
('Topi Bucket Hat', 'AKS-003', 65000, 30, 5, 'products/topi-bucket.jpg', NOW(), NOW()),
('Totebag Canvas', 'AKS-004', 55000, 50, 5, 'products/totebag.jpg', NOW(), NOW()),
('Socks Pack 3pcs', 'AKS-005', 45000, 60, 5, 'products/socks.jpg', NOW(), NOW()),
('Masker Cloth 5pcs', 'AKS-006', 35000, 100, 5, 'products/masker.jpg', NOW(), NOW());