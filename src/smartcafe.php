<?php
// 1. Ép kiểu (Casting) từ string sang int
$quantity = (int) $rawQuantity;

// 2. Tính Subtotal
$subtotal = $unitPrice * $quantity;

// 3. Tính Discount (Chiết khấu)
$isMember = $customerStatus === "MEMBER"; // Dùng strict equality (===)
$isDiscountEligible = $isMember && $subtotal >= MEMBER_MIN;
$discount = $isDiscountEligible ? $subtotal * MEMBER_DISCOUNT_RATE : 0;

// 4. Tính phí bao bì và phí dịch vụ
$packagingFee = $quantity * PACKAGING_FEE_PER_ITEM;
$afterDiscount = $subtotal - $discount;
$serviceFee = $afterDiscount * SERVICE_RATE;

// 5. Tính Total
$total = $subtotal - $discount + $packagingFee + $serviceFee;

// 6. Kiểm tra điều kiện Checkout Gate
$hasValidQuantity = $quantity > 0;
$hasValidStatus = $customerStatus === "MEMBER" || $customerStatus === "GUEST";
$canCheckout = $hasValidQuantity && $productAvailable && $hasValidStatus;