package handler

import (
	"sort"
	"strconv"

	"github.com/gofiber/fiber/v3"
	"latihan-fiber-api/internal/model"
)

func DaftarMahasiswa(c fiber.Ctx) error {
	angkatan := c.Query("angkatan", "")
	urutkan := c.Query("urut", "")

	// Salin data daftar mahasiswa agar tidak mengubah data asli
	hasil := make([]model.Mahasiswa, len(model.Daftar))
	copy(hasil, model.Daftar)

	if angkatan != "" {
		nilaiAngkatan, err := strconv.Atoi(angkatan)
		if err != nil {
			return fiber.NewError(fiber.StatusBadRequest, "Parameter angkatan harus berupa angka")
		}

		filtered := []model.Mahasiswa{}
		for i := 0; i < len(hasil); i++ {
			if hasil[i].Angkatan == nilaiAngkatan {
				filtered = append(filtered, hasil[i])
			}
		}
		hasil = filtered
	}

	// Tugas Praktikum No 2: Pengurutan berdasarkan 'nama' atau 'ipk'
	if urutkan == "nama" {
		sort.Slice(hasil, func(i, j int) bool {
			return hasil[i].Nama < hasil[j].Nama
		})
	} else if urutkan == "ipk" {
		sort.Slice(hasil, func(i, j int) bool {
			return hasil[i].Ipk > hasil[j].Ipk
		})
	}

	return c.JSON(fiber.Map{
		"sukses": true,
		"data":   hasil,
	})
}

func DetailMahasiswa(c fiber.Ctx) error {
	id, err := strconv.Atoi(c.Params("id"))
	if err != nil {
		return fiber.NewError(fiber.StatusBadRequest, "ID harus berupa angka")
	}

	for i := 0; i < len(model.Daftar); i++ {
		if model.Daftar[i].ID == id {
			return c.JSON(fiber.Map{
				"sukses": true,
				"data":   model.Daftar[i],
			})
		}
	}

	return fiber.NewError(fiber.StatusNotFound, "Mahasiswa tidak ditemukan")
}

func DetailMahasiswaByNim(c fiber.Ctx) error {
	nimTarget := c.Params("nim")

	for i := 0; i < len(model.Daftar); i++ {
		if model.Daftar[i].Nim == nimTarget {
			return c.JSON(fiber.Map{
				"sukses": true,
				"data":   model.Daftar[i],
			})
		}
	}

	return fiber.NewError(fiber.StatusNotFound, "Mahasiswa dengan NIM tersebut tidak ditemukan")
}