<?php
class UserType {
  const superAdmin = "superadmin";
  const admin = "admin";
  const cashier = "cashier";
  const kitchen = "kitchen";
  const waiter = "waiter";
}

class OrderStatus{
  const pending = "Pending";
  const cancelled = "Cancelled";
  const processing = "Processing";
  const processed = "Processed";
  const forServing = "Ready For Serving";
  const served = "Served";
  const forPayment = "For Payment";
  const complete = "Complete";

  static function getList() {
    return array(self::pending, self::cancelled,
                 self::processing, self::processed,
                 self::forServing, self::served,
                 self::forPayment, self::complete);
  }
}