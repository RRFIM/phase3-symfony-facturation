<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column(enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\Column]
    private ?float $total_ttc = null;

    #[ORM\Column]
    private ?\DateTime $created_at = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'invoice')]
    private Collection $user_id;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'invoice')]
    private Collection $client_id;

    #[ORM\ManyToOne(inversedBy: 'invoice_id')]
    private ?InvoiceItem $invoiceItem = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->client_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalTtc(): ?float
    {
        return $this->total_ttc;
    }

    public function setTotalTtc(float $total_ttc): static
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->setInvoice($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getInvoice() === $this) {
                $userId->setInvoice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClientId(): Collection
    {
        return $this->client_id;
    }

    public function addClientId(Client $clientId): static
    {
        if (!$this->client_id->contains($clientId)) {
            $this->client_id->add($clientId);
            $clientId->setInvoice($this);
        }

        return $this;
    }

    public function removeClientId(Client $clientId): static
    {
        if ($this->client_id->removeElement($clientId)) {
            // set the owning side to null (unless already changed)
            if ($clientId->getInvoice() === $this) {
                $clientId->setInvoice(null);
            }
        }

        return $this;
    }

    public function getInvoiceItem(): ?InvoiceItem
    {
        return $this->invoiceItem;
    }

    public function setInvoiceItem(?InvoiceItem $invoiceItem): static
    {
        $this->invoiceItem = $invoiceItem;

        return $this;
    }
}
