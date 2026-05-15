<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceItemRepository::class)]
class InvoiceItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    /**
     * @var Collection<int, Invoice>
     */
    #[ORM\OneToMany(targetEntity: Invoice::class, mappedBy: 'invoiceItem')]
    private Collection $invoice_id;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'invoiceItem')]
    private Collection $product_id;

    public function __construct()
    {
        $this->invoice_id = new ArrayCollection();
        $this->product_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoiceId(): Collection
    {
        return $this->invoice_id;
    }

    public function addInvoiceId(Invoice $invoiceId): static
    {
        if (!$this->invoice_id->contains($invoiceId)) {
            $this->invoice_id->add($invoiceId);
            $invoiceId->setInvoiceItem($this);
        }

        return $this;
    }

    public function removeInvoiceId(Invoice $invoiceId): static
    {
        if ($this->invoice_id->removeElement($invoiceId)) {
            // set the owning side to null (unless already changed)
            if ($invoiceId->getInvoiceItem() === $this) {
                $invoiceId->setInvoiceItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductId(): Collection
    {
        return $this->product_id;
    }

    public function addProductId(Product $productId): static
    {
        if (!$this->product_id->contains($productId)) {
            $this->product_id->add($productId);
            $productId->setInvoiceItem($this);
        }

        return $this;
    }

    public function removeProductId(Product $productId): static
    {
        if ($this->product_id->removeElement($productId)) {
            // set the owning side to null (unless already changed)
            if ($productId->getInvoiceItem() === $this) {
                $productId->setInvoiceItem(null);
            }
        }

        return $this;
    }
}
