package router

import (
	"github.com/gofiber/fiber/v3"
	"latihan-fiber-api/internal/handler"
	"latihan-fiber-api/internal/middleware"
)

func Daftarkan(app *fiber.App, apiKeyRahasia string) {
	api := app.Group("/api")

	api.Get("/status", func(c fiber.Ctx) error {
		return c.JSON(fiber.Map{
			"sukses": true,
			"pesan":  "API Fiber aktif",
		})
	})

	// Menggunakan middleware.KunciApi di sini sehingga import tidak sia-sia	
	mahasiswa := api.Group("/mahasiswa", middleware.KunciApi(apiKeyRahasia))
	mahasiswa.Get("/", handler.DaftarMahasiswa)
	mahasiswa.Get("/:id", handler.DetailMahasiswa)
	mahasiswa.Get("/nim/:nim", handler.DetailMahasiswaByNim)
}