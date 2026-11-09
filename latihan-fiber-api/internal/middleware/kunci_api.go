package middleware

import (
    "github.com/gofiber/fiber/v3"
)

func KunciApi(expectedKey string) fiber.Handler {
    return func(c fiber.Ctx) error {
        clientKey := c.Get("X-Api-Key")
        if clientKey != expectedKey {
            return fiber.NewError(fiber.StatusUnauthorized, "Akses ditolak: API Key tidak valid atau tidak disertakan")
        }
        return c.Next()
    }
}